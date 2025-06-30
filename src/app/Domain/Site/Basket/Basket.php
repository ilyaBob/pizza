<?php

namespace Domain\Site\Basket;

use Domain\Site\Basket\Factory\BasketFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Basket extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'price',
        'quantity',
        'session_id',
        'order_id'
    ];

    protected static function newFactory(): BasketFactory
    {
        return BasketFactory::new();
    }
}
