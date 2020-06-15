<?php

namespace App\Traits;

trait MyAsserts
{
    private function my_asserts($user,$data)
    {
        $this->assertEquals($data['name'],$user->name);
        $this->assertEquals($data['email'],$user->email);
        $this->assertEquals($data['address'],$user->address);
        $this->assertEquals($data['role'],$user->role);
        $this->assertEquals($data['phone'],$user->phone);
    }

    private function get_valid_data(Array $array=[])
    {
        $valid_data=[
            "name"=>"ramy",
            "email"=>"r@r.com",
            "address" => "addresssssss",
            "phone" => "01111287447",
            "password"=>'123456789',
            "password_confirmation"=>'123456789',
        ];
        return array_merge($valid_data,$array);
    }
}
