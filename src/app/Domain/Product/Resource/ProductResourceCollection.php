<?php

namespace Domain\Product\Resource;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductResourceCollection extends ResourceCollection
{
    public $collection = ProductResource::class;
}
