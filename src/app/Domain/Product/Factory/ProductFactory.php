<?php

namespace Domain\Product\Factory;

use Domain\Product\Enum\ProductTypeEnum;
use Domain\Product\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->words(3, true),
            'description' => $this->faker->words(10, true),
            'price' => rand(100, 500),
            'type' => ProductTypeEnum::randomValue(),
        ];
    }
}
