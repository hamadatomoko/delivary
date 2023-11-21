<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MenuControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_guestTest()
    {
        // $response = $this->get(route('menu.index'));
        $response = $this->get(route('admin.login'));

        $response->assertStatus(200);
    }
    public function testUserRegister()
    {
        $data = [
        'name'                  => 'juno',
        'email'                 => 'juno@email.com',
        'tel'                   => '0120-21-3456'
        'Address'               =>'東京都港区'
        'password'              => 'test1234',
        'password_confirmation' => 'test1234',
    ];

        $response = $this->postJson(route('register'), $data);

        $response->assertStatus(302)
        ->assertRedirect('/home');
    }
}
