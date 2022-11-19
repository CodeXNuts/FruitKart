<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BasicTest extends TestCase
{
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // test for home redirection to buyer login
    public function test_home()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    //buyer registration test
    public function test_new_buyer_can_register()
    {
        $response = $this->post('/buyer/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'username' => 'testUname',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $this->assertAuthenticated('buyer');
        $response->assertRedirect(RouteServiceProvider::BUYER);
    }

    //buyer can login
    public function test_buyer_can_login()
    {
        $response = $this->post('/buyer/login', [
            'email' => 'test@example.com',
            'password' => 'password'
        ]);

        $this->assertAuthenticated('buyer');
        $response->assertRedirect(RouteServiceProvider::BUYER);
    }

    //seller registration test
    public function test_new_seller_can_register()
    {
        $response = $this->post('/seller/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'username' => 'testUname',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/seller/register');
    }

    //seller can login
    public function test_seller_can_login()
    {
        $response = $this->post('/seller/login', [
            'email' => 'test@example.com',
            'password' => 'password'
        ]);

        $this->assertAuthenticated('seller');
        $response->assertRedirect(RouteServiceProvider::SELLER);
    }
}
