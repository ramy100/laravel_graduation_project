<?php

namespace Tests\Feature;

use App\Traits\MyAsserts;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRegisterationTest extends TestCase
{
    use MyAsserts;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    /** @test */
    public function Example()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    /** @test */
    public function logged_in_user_cant_see_user_registeration_form()
    {
        $this->actingAs(factory(User::class)->create());
        $response = $this->get('register/user');
        $response->assertRedirect('/');
    }
    /** @test */
    public function logged_in_company_cant_see_user_registeration_form()
    {
        $this->actingAs(factory(User::class)->create(['role'=>'company']));
        $response = $this->get('register/user');
        $response->assertRedirect();
    }
    /** @test */
    public function logged_in_designer_cant_see_user_registeration_form()
    {
        $this->actingAs(factory(User::class)->create(['role'=>'designer']));
        $response = $this->get('register/user');
        $response->assertRedirect();
    }
    /** @test */
    public function logged_in_admin_can_see_user_registeration_form()
    {
        $this->actingAs(factory(User::class)->create(['role'=>'admin']));
        $response = $this->get('register/user');
        $response->assertOk();
    }
    /** @test */
    public function user_can_be_created_from_user_registeration_form()
    {
        $response = $this->post('register/user',$this->get_valid_data());
        $user = User::first();
        $this->assertEquals('user',$user->role);
    }
    /** @test */
    public function admin_cannot_be_created_from_user_registeration_form()
    {
        $response = $this->post('register/user',$this->get_valid_data(['role'=>'admin']));
        $user = User::first();
        $this->assertEquals('user',$user->role);
    }
    /** @test */
    public function user_registeration_form_validation()
    {
        $response = $this->post('register/user',['about'=>'a','phone'=>'011']);
        $response->assertSessionHasErrors(['name','password','email','about','phone']);
        $response->assertSessionDoesntHaveErrors(['document']);
    }
}
