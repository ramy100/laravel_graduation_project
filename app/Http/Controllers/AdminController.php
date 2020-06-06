<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Response;
use Illuminate\Auth\Events\Registered;
class AdminController extends RegisterController
{

    public function __construct(){
        $this->middleware('check-role:admin');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new Response('', 201)
                    : redirect($this->redirectPath());
    }

    
    public function showRegistrationForm(){
            return view('auth.allregister',[
                'route'=>'admin.register',
                'role'=>'Admin'
            ]);
        }

    protected function create(array $data)
    {
        if(array_key_exists("image",$data))
            $image = $data['image']->store('uploads', 'public');
        else
            $image="images/default.jpg";

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'image' => $image,
            'role' => 'admin',
            'password' => Hash::make($data['password']),
        ]);
    }
}
