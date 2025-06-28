<?php

namespace Domain\Site\Basket\Resource;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BasketResourceCollection extends ResourceCollection
{
    public $collection = BasketResource::class;
}
