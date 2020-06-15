<?php

namespace Tests\Feature;

use App\Profile;
use App\Traits\MyAsserts;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
class DesignerRegisterationTest extends TestCase
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
    public function logged_in_designer_cant_see_designer_registeration_form()
    {
        $this->actingAs(factory(User::class)->create());
        $response = $this->get('register/designer');
        $response->assertRedirect('/');
    }
    /** @test */
    public function logged_in_admin_can_see_designer_registeration_form()
    {
        $this->actingAs(factory(User::class)->create(['role'=>'admin']));
        $response = $this->get('register/designer');
        $response->assertOk();
    }
    /** @test */
    public function logged_in_company_cant_see_designer_registeration_form()
    {
        $this->actingAs(factory(User::class)->create(['role'=>'company']));
        $response = $this->get('register/designer');
        $response->assertRedirect();
    }
    /** @test */
    public function logged_in_user_cant_see_designer_registeration_form()
    {
        $this->actingAs(factory(User::class)->create(['role'=>'user']));
        $response = $this->get('register/designer');
        $response->assertRedirect();
    }
    /** @test */
    public function designer_registeration_form_validation()
    {
        $response = $this->post('register/designer',['about'=>'a','phone'=>'011','document'=>'sa']);
        $response->assertSessionHasErrors(['name','password','email','about','phone','document']);
    }

}
