<?php

namespace Database\Seeders;

use Domain\Order\Order;
use Domain\Site\Basket\Basket;
use Domain\User\Enum\RoleEnum;
use Domain\User\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Domain\Product\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'admin',
            'role' => RoleEnum::ADMIN->value,
            'phone' => '+79992227771',
            'password' =>  Hash::make('adminadmin'),
        ]);

        User::factory()->create([
            'name' => 'user',
            'role' => RoleEnum::USER->value,
            'phone' => '+79992227772',
            'password' =>  Hash::make('useruser'),
        ]);
        User::factory()->create([
            'name' => 'user2',
            'role' => RoleEnum::USER->value,
            'phone' => '+79992227773',
            'password' =>  Hash::make('user2user2'),
        ]);

        Product::factory(5)->create();

        Order::factory(5)->create();

        Basket::factory(10)->create();
    }
}
