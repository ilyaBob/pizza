<?php

namespace Domain\Order\Tests\Feature;

use App\Tests\AdminAuthTestCase;
use Domain\Order\Enum\OrderStatusEnum;
use Domain\Order\Order;

class OrderControllerTest extends AdminAuthTestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->cleanModel(Order::class);
    }

    // ************************************** Index **************************************
    public function testCorrectIndex()
    {
        $response = $this->get(route('admin.orders.index'));
        $response->assertStatus(200);
    }

    // ************************************** Update **************************************
    public function testCorrectUpdate()
    {
        $order = Order::factory()->create([
            'status_id' => OrderStatusEnum::WORK->value
        ]);

        $response = $this->patch(route('admin.orders.update', $order->id), [
            'status_id' => OrderStatusEnum::DELIVERY->value
        ]);

        $response->assertStatus(200);

        $this->assertEquals(OrderStatusEnum::DELIVERY->value, $order->fresh()->status_id);
    }

    public function testIncorrectUpdate()
    {
        $order = Order::factory()->create();

        $response = $this->patch(route('admin.orders.update', $order->id), [
            'status_id' => 22
        ]);

        $response->assertStatus(422);

    }

}
