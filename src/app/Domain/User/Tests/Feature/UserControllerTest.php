<?php

namespace Domain\User\Tests\Feature;

use App\Tests\BaseTest;
use Domain\User\User;

class UserControllerTest extends BaseTest
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->cleanModel(User::class);
    }

    // ************************************** Register **************************************
    public function testCorrectRegister()
    {
        $data = [
            "name" => "Johnss Doe",
            "phone" => "+79821233232",
            "password" => "password",
            "password_confirmation" => "password"
        ];

        $response = $this->post(route('register'), $data);
        $response->assertStatus(201);
        $this->assertNotNull($response->json('token'));
    }

    public function testIncorrectRegister()
    {
        $data = [
            "name" => "Johnss Doe",
            "phone" => "+79821233232",
            "password" => "password",
        ];

        $response = $this->post(route('register'), $data);
        $response->assertStatus(422);
    }

    // ************************************** Login **************************************
    public function testCorrectLogin()
    {
        $data = [
            "name" => "Johnss Doe",
            "phone" => "+79821233232",
            "password" => "password",
            "password_confirmation" => "password"
        ];

        $response = $this->post(route('register'), $data);
        $response->assertStatus(201);

        $responseLogin = $this->post(route('login'), $data);
        $responseLogin->assertStatus(200);
    }

    public function testIncorrectLogin()
    {
        $data = [
            "name" => "Johnss Doe",
            "phone" => "+79821233232",
            "password" => "password",
            "password_confirmation" => "password"
        ];

        $response = $this->post(route('register'), $data);
        $response->assertStatus(201);

        $data['phone'] = "+79821233233";
        $responseLogin = $this->post(route('login'), $data);
        $responseLogin->assertStatus(401);
    }


    // ************************************** Me **************************************
    public function testCorrectMe()
    {
        $data = [
            "name" => "Johnss Doe",
            "phone" => "+79821233232",
            "password" => "password",
            "password_confirmation" => "password"
        ];

        $response = $this->post(route('register'), $data);
        $response->assertStatus(201);


        $responseMe = $this->get(route('me'), [
            'Authorization' => "Bearer " . $response->json('token')
        ]);
        $responseMe->assertStatus(200);

        $this->assertEquals($data['name'], $responseMe->json('name'));
    }

    public function testIncorrectMe()
    {
        $data = [
            "name" => "Johnss Doe",
            "phone" => "+79821233232",
            "password" => "password",
            "password_confirmation" => "password"
        ];

        $response = $this->post(route('register'), $data);
        $response->assertStatus(201);


        $responseMe = $this->get(route('me'), [
            'Authorization' => "Bearer 1" . $response->json('token')
        ]);
        $responseMe->assertStatus(401);

    }

    // ************************************** Logout **************************************
    public function testCorrectLogout()
    {
        $data = [
            "name" => "Johnss Doe",
            "phone" => "+79821233232",
            "password" => "password",
            "password_confirmation" => "password"
        ];

        $response = $this->post(route('register'), $data);
        $response->assertStatus(201);


        $responseMe = $this->get(route('me'), [
            'Authorization' => "Bearer " . $response->json('token')
        ]);
        $responseMe->assertStatus(200);

        $responseMe = $this->post(route('logout'), [
            'Authorization' => "Bearer " . $response->json('token')
        ]);
        $responseMe->assertStatus(200);

    }

    public function testIncorrectLogout()
    {
        $data = [
            "name" => "Johnss Doe",
            "phone" => "+79821233232",
            "password" => "password",
            "password_confirmation" => "password"
        ];

        $response = $this->post(route('register'), $data);
        $response->assertStatus(201);


        $responseMe = $this->get(route('me'), [
            'Authorization' => "Bearer " . $response->json('token')
        ]);
        $responseMe->assertStatus(200);

        $responseMe = $this->post(route('logout'), [
            'Authorization' => "Bearer 122" . $response->json('token')
        ]);
        $responseMe->assertStatus(200);

    }
}
