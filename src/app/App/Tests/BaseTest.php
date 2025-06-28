<?php

namespace App\Tests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase;

class BaseTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function cleanModel(string $model): void
    {
        (new $model())::query()->where('id', '<>', 0)->forceDelete();
    }
}
