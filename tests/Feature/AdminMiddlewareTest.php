<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminMiddlewareTest extends TestCase
{
    use RefreshDatabase;
    public function test_admin_can_view_register_admin_page()
    {
        $this->actingAs(factory(User::class)->create(['role'=>'admin']));
        $response = $this->get('/admin/create');
        $response->assertOk();
    }
    public function test_user_cant_view_register_admin_page()
    {
        $this->actingAs(factory(User::class)->create(['role'=>'user']));
        $response = $this->get('/admin/create');
        $response->assertRedirect('/403');
    }
    public function test_company_cant_view_register_admin_page()
    {
        $this->actingAs(factory(User::class)->create(['role'=>'company']));
        $response = $this->get('/admin/create');
        $response->assertRedirect('/403');
    }
    public function test_designer_cant_view_register_admin_page()
    {
        $this->actingAs(factory(User::class)->create(['role'=>'designer']));
        $response = $this->get('/admin/create');
        $response->assertRedirect('/403');
    }
}
