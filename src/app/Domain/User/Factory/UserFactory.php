<?php

namespace Domain\User\Factory;

use Domain\User\Enum\RoleEnum;
use Domain\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'role' => RoleEnum::randomValue(),
            'phone' => rand(100, 500),
            'password' => Hash::make($this->faker->words(1, true)),
        ];
    }
}
