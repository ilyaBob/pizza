<?php

namespace Domain\Site\Basket\Factory;

use Domain\Product\Product;
use Domain\Site\Basket\Basket;
use Domain\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BasketFactory extends Factory
{
    protected $model = Basket::class;

    public function definition(): array
    {
        return [
            'user_id' => User::query()->inRandomOrder()->firstOrFail()->id,
            'session_id' => Str::random(40),
            'price' => rand(100, 500),
            'product_id' => Product::query()->inRandomOrder()->firstOrFail()->id,
            'quantity' => rand(1, 5),
            'is_active' => true,
        ];
    }
}
