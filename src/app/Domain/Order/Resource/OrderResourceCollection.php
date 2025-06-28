<?php

namespace Domain\Order\Resource;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderResourceCollection extends ResourceCollection
{
    public $collection = OrderResource::class;
}
