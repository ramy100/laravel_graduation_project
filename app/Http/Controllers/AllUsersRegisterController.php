<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Response;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class AllUsersRegisterController extends RegisterController
{
    public function __construct(Request $request){
        if ($request->is('register/admin')){
            $this->middleware('check-role:admin');
        }else{
            $this->middleware('guest');
        }
    }
    // Showing Registeration form dynamically
    public function RegistrationForm(Request $request,$role){
        return view('auth.allregister',[
            'route'=>$role.'.registeration',
            'role'=>$role
        ]);
    }

    // registeration method
    public function register(Request $request)
    {
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
        $this->validator($request->all())->validate();
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
        if(array_key_exists("image",$data))
            $image = $data['image']->store('uploads', 'public');
        else
            $image=null;

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'image' => $image,
            'role' => $role,
            'password' => Hash::make($data['password']),
        ]);
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
}