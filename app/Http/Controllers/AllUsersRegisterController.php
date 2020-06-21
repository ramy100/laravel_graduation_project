<?php

namespace App\Http\Controllers;

use App\Admin;
use App\DesignersBalance;
use App\Events\RegisterationEvent;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Auth\RegisterController;
use App\Notifications\AdminNotifications;
use App\Profile;
use Illuminate\Http\Response;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class AllUsersRegisterController extends RegisterController
{
    public function __construct(Request $request){
        if (!$request->is('register/admin')){
            $this->middleware('admin-or-guest');
        }
    }

    public function createAccount(Request $request)
    {
        return view('auth.createAccount');
    }

    // Showing Registeration form dynamically
    public function RegistrationForm(Request $request,$role){
        $this->authorize_registeration_forms($request);
        return view('auth.allregister',[
            'route'=>$role.'.registeration',
            'role'=>$role
        ]);
    }

    // registeration method
    public function register(Request $request)
    {
        $this->authorize_registeration_forms($request);
        if ($request->is('register/admin')){
            $role = 'admin';
        }elseif ($request->is('register/company')) {
            $role = 'company';
        }elseif ($request->is('register/user')) {
            $role = 'user';
        }elseif ($request->is('register/designer')) {
            $role = 'designer';
        }
        
        // validating request data
        $this->validator($request->all(),$role)->validate();
        // creating a new user   
        event(new Registered($user = $this->create_new_user($request->all(),$role)));

        if ($response = $this->registered($request, $user)) {
            return $response;
        }
        // login user immediatly after registertaion success
        if (!Auth::check()) {
            $this->guard()->login($user);
        }
        
        return $request->wantsJson()
                    ? new Response('', 201)
                    : redirect($this->redirectPath());
    }

    
    

    protected function create_new_user(array $data,$role)
    {
        try {
            DB::beginTransaction();
            if(array_key_exists("image",$data))
                $image_path = $data['image']->store('uploads', 'public');
            else
                $image_path=null;

            if(array_key_exists("document",$data))
                $document_path = $data['document']->store('Files', 'public');

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'address' => $data['address'],
                'phone' => $data['phone'],
                'image' => $image_path,
                'role' => $role,
                'password' => Hash::make($data['password']),
            ]);
            if($role === 'designer'){
                $user->balance()->create();
            }
            // create profile if role is company
            if($role === 'company' || $role==='designer'){
                Profile::create([
                    'user_id'=>$user->id,
                    'about'=>$data['about'],
                    'website'=>$data['website'],
                    'document'=>$document_path,
                    'is_verified'=>'pending',
                ]);
                $user->createAsStripeCustomer();
                $admins=Admin::all();
                Notification::send($admins, new AdminNotifications($role));
                event(new RegisterationEvent('New Pending '.$role,route('list_users',[$role,'pending']),$user->created_at));
            }
        } catch (\Throwable $th) {
            // delete user if an error arises and return server error
            DB::rollBack();
            return abort(500);}
        // commit changes if every thing goes ok
        Db::commit();
        return $user;
    }
    
    
    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }

    protected function authorize_registeration_forms(Request $request)
    {
        $user=Auth::user();
        if ($request->is('register/admin')){
            $this->authorize('create',$user);
        }
    }
}