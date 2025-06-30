<?php

namespace Domain\Site\Order\Resource;

use Domain\Site\Basket\Resource\BasketResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request): array
    {
        $baskets = $this->basket;
        $orderPrice = $baskets->map(function ($item) {
            return $item->price * $item->quantity;
        })->sum();

        return [
            'id' => $this->id,
            'status_id' => $this->status_id,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'time_delivery' => $this->time_delivery,
            'price' => $orderPrice,
            'baskets' => new BasketResourceCollection($baskets)
        ];
    }
}
