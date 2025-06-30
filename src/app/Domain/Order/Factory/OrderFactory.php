<?php

namespace Domain\Order\Factory;

use Domain\Order\Enum\OrderStatusEnum;
use Domain\Order\Order;
use Domain\User\Enum\RoleEnum;
use Domain\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'user_id' => User::query()->where('role', RoleEnum::USER->value)->inRandomOrder()->firstOrFail()->id,
            'status_id' => OrderStatusEnum::randomValue(),
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'address' => $this->faker->words(3, true),
            'time_delivery' => $this->faker->dateTime,
        ];
    }
}
