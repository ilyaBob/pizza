<?php

namespace Domain\Order\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderShowResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'status_id' => $this->status_id,
        ];
    }
}
