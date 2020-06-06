<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use App\User;
use Illuminate\Support\Facades\Hash;

class DesignerController extends RegisterController
{
    
    public function showRegistrationForm()
    {
        return view('auth.allregister',[
            'route'=>'designer.register',
            'role'=>'Designer'
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
            'role' => 'designer',
            'password' => Hash::make($data['password']),
        ]);
    }

}
