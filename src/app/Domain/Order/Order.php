<?php

namespace Domain\Order;

use Domain\Order\Factory\OrderFactory;
use Domain\Site\Basket\Basket;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'user_id',
        'status_id',
        'phone',
        'email',
        'address',
        'time_delivery',
    ];

    protected static function newFactory(): OrderFactory
    {
        return OrderFactory::new();
    }

    public function basket(): HasMany
    {
        return $this->hasMany(Basket::class);
    }
}
