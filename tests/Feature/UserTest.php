<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class UserTest extends TestCase
{
    use RefreshDatabase;
    public function test_not_logged_in_users_cant_see_home_page()
    {
        $response = $this->get('/home');
        $response->assertRedirect('/login');
    }

    public function test_logged_in_users_cant_see_register_page()
    {
        $this->actingAs(factory(User::class)->create());
        $response = $this->get('/register');
        $response->assertRedirect('/home');
    }

    public function test_logged_in_users_cant_see_login_page()
    {
        $this->actingAs(factory(User::class)->create());
        $response = $this->get('/login');
        $response->assertRedirect('/home');
    }


    public function test_logged_in_users_can_see_home_page()
    {
        $this->actingAs(factory(User::class)->create());
        $response = $this->get('/home');
        $response->assertOk();
    }

    public function test_user_can_be_created_through_form()
    {
        
        $this->withoutExceptionHandling();
        $response = $this->post("/register",[
            "name"=>"ramy",
            "email"=>"r@r.com",
            "address" => "addresssssss",
            "phone" => "01111287447",
            "role" => "user",
            "password"=>'123456789',
            "password_confirmation"=>'123456789'
        ]);
        $users = User::first();
        $this->assertEquals('ramy',$users->name);
        $this->assertEquals('r@r.com',$users->email);
        $this->assertEquals('addresssssss',$users->address);
        $this->assertEquals('user',$users->role);
        $this->assertEquals('01111287447',$users->phone);
    }


    public function test_user_can_be_created_through_form_with_wrong_phone_format()
    {
        $response = $this->post("/register",[
            "name"=>"ramy",
            "email"=>"r@r.com",
            "address" => "address",
            "phone" => "00111287447",
            "role" => "user",
            "password"=>'123456789',
            "password_confirmation"=>'123456789'
            ]);
        $response->assertSessionHasErrors('phone');
    }

    public function test_user_can_be_created_through_form_without_phone()
    {
        $this->withoutExceptionHandling();

        $response = $this->post("/register",[
            "name"=>"ramy",
            "email"=>"r@r.com",
            "address" => "addresssssssssssssss",
            "role" => "user",
            'phone'=>null,
            "password"=>'123456789',
            "password_confirmation"=>'123456789'
        ]);
        $users = User::first();
        $this->assertEquals('ramy',$users->name);
        $this->assertEquals('r@r.com',$users->email);
        $this->assertEquals('addresssssssssssssss',$users->address);
        $this->assertEquals('user',$users->role);
        $this->assertEquals(null,$users->phone);
    }

    public function test_user_can_be_created_through_form_without_address()
    {
        $this->withoutExceptionHandling();

        $response = $this->post("/register",[
            "name"=>"ramy",
            "email"=>"r@r.com",
            "address" => null,
            "role" => "user",
            'phone'=>'01111287447',
            "password"=>'123456789',
            "password_confirmation"=>'123456789'
        ]);
        $users = User::first();
        $this->assertEquals('ramy',$users->name);
        $this->assertEquals('r@r.com',$users->email);
        $this->assertEquals(null,$users->address);
        $this->assertEquals('user',$users->role);
        $this->assertEquals('01111287447',$users->phone);
    }
    
}
