<?php

namespace Domain\Order\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'status_id' => $this->status_id,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'time_delivery' => $this->time_delivery,
        ];
    }
}
