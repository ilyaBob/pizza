<?php

namespace Domain\Site\Order\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'status_id' => $this->status_id,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'time_delivery' => $this->time_delivery,
        ];
    }
}
