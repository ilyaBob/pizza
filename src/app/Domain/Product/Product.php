<?php

namespace Domain\Product;

use Domain\Product\Factory\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'type'
    ];

    protected static function newFactory(): ProductFactory
    {
        return ProductFactory::new();
    }
}
