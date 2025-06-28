<?php

namespace Domain\Site\Basket\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class BasketResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'price' => $this->price,
            'quantity' => $this->quantity,
        ];
    }
}
