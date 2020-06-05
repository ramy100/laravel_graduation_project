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
        $response = $this->post("/register",$this->get_valid_data());
        $user = User::first();
        $this->my_asserts($user,$this->get_valid_data());

    }


    public function test_user_can_be_created_through_form_with_wrong_phone_format()
    {
        $response = $this->post("/register",array_merge($this->get_valid_data(),['phone'=>'00111287447']));
        $response->assertSessionHasErrors('phone');
    }

    public function test_user_can_be_created_through_form_without_phone()
    {
        $this->withoutExceptionHandling();

        $response = $this->post("/register",array_merge($this->get_valid_data(),['phone'=>null]));
        $user = User::first();
        $this->my_asserts($user,array_merge($this->get_valid_data(),['phone'=>null]));

    }

    public function test_user_can_be_created_through_form_without_address()
    {
        $this->withoutExceptionHandling();

        $response = $this->post("/register",array_merge($this->get_valid_data(),['address'=>null]));
        $user = User::first();
        $this->my_asserts($user,array_merge($this->get_valid_data(),['address'=>null]));

    }

    public function test_admin_can_be_created_from_create_admin_form()
    {
        $this->withoutExceptionHandling();

        $response = $this->post("/admin/register",$this->get_valid_data());
        $user = User::first();
        $this->my_asserts($user,array_merge($this->get_valid_data(),['role'=>'admin']));
        
    }
    public function test_user_can_be_created_from_create_user_form()
    {
        $this->withoutExceptionHandling();

        $response = $this->post("/user/register",$this->get_valid_data());
        $user = User::first();
        $this->my_asserts($user,array_merge($this->get_valid_data(),['role'=>'user']));
        
    }
    public function test_company_can_be_created_from_create_company_form()
    {
        $this->withoutExceptionHandling();

        $response = $this->post("/company/register",$this->get_valid_data());
        $user = User::first();
        $this->my_asserts($user,array_merge($this->get_valid_data(),['role'=>'company']));
        
    }
    public function test_designer_can_be_created_from_create_designer_form()
    {
        $this->withoutExceptionHandling();

        $response = $this->post("/designer/register",$this->get_valid_data());
        $user = User::first();
        $this->my_asserts($user,array_merge($this->get_valid_data(),['role'=>'designer']));
        
    }


    private function my_asserts($user,$data)
    {
        $this->assertEquals($data['name'],$user->name);
        $this->assertEquals($data['email'],$user->email);
        $this->assertEquals($data['address'],$user->address);
        $this->assertEquals($data['role'],$user->role);
        $this->assertEquals($data['phone'],$user->phone);
    }

    private function get_valid_data()
    {
        return [
            "name"=>"ramy",
            "email"=>"r@r.com",
            "address" => "addresssssss",
            "phone" => "01111287447",
            "role" => "user",
            "password"=>'123456789',
            "password_confirmation"=>'123456789'
        ];
    }
    
}
