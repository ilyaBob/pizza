<?php

namespace Domain\Site\Order\Tests\Feature;

use App\Tests\UserAuthTestCase;
use Domain\Order\Order;
use Domain\Product\Enum\ProductTypeEnum;
use Domain\Product\Product;
use Domain\Site\Basket\Basket;

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

    // ************************************** Store **************************************
    public function testCorrectStore()
    {
         $product1 = Product::factory()->create([
            'type' => ProductTypeEnum::DRINK->value,
             'price' => '100'
        ]);
         $product2 = Product::factory()->create([
            'type' => ProductTypeEnum::PIZZA->value,
             'price' => '500'
        ]);

        $basket1 =Basket::factory()->create([
            'user_id' => $this->user->id,
            'product_id' => $product1->id,
            'quantity' => 1,
            'price' => 100
        ]);
        $basket2 = Basket::factory()->create([
            'user_id' => $this->user->id,
            'product_id' => $product2->id,
            'quantity' => 1,
            'price' => 500
        ]);


        $data = [
            'phone' => '+71112223344',
            'email' => null,
            'address' => '111',
            'time_delivery' => '2025-11-11 10:45',
        ];

        $response = $this->post(route('orders.store'), $data);
        $response->assertStatus(201);

        $this->assertEquals($basket1->fresh()->order_id, $response->json('id'));
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
