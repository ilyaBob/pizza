<?php

namespace App\Tests;

use Domain\User\Enum\RoleEnum;
use Domain\User\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\Hash;

class UserAuthTestCase extends BaseTest
{
    use DatabaseTransactions;

    protected ?User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::create([
            'name' => 'user',
            'phone' => '0123456789',
            'password' => Hash::make('password'),
        ]);
        $user->role = RoleEnum::USER->value;
        $user->save();

        $this->actingAs($user);
        $this->user = $user;
    }
}
