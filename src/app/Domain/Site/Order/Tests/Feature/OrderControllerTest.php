<?php

namespace Domain\Site\Order\Tests\Feature;

use App\Tests\UserAuthTestCase;
use Domain\Order\Order;

class OrderControllerTest extends UserAuthTestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->cleanModel(Order::class);
    }

    // ************************************** Index **************************************
    public function testCorrectIndex()
    {
        Order::factory()->create([
            'user_id' => $this->user->id
        ]);
        Order::factory()->create([
            'user_id' => $this->user->id
        ]);

        Order::factory()->create([
            'user_id' => 99,
        ]);

        $response = $this->get(route('orders.index'));
        $response->assertStatus(200);

        $this->assertCount(2, $response->json());
    }

    // ************************************** Update **************************************
    public function testCorrectStore()
    {
        $data = [
            'phone' => '+71112223344',
            'email' => null,
            'address' => '111',
            'time_delivery' => '2025-11-11 10:45',
        ];

        $response = $this->post(route('orders.store'), $data);
        $response->assertStatus(201);
    }

    public function testIncorrectStore()
    {
        $data = [
            'email' => '111',
            'address' => '111',
            'time_delivery' => '2025-11-11 10:45',
        ];

        $response = $this->post(route('orders.store'), $data);
        $response->assertStatus(422);
    }

    public function testIncorrectStoreTimeDelivery()
    {
        $data = [
            'phone' => '+71112223344',
            'address' => '111',
            'time_delivery' => '2025-11-11',
        ];

        $response = $this->post(route('orders.store'), $data);
        $response->assertStatus(422);
    }
}
