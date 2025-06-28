<?php

namespace Domain\Order;

use App\Http\Controllers\Controller;
use Domain\Order\Request\UpdateOrderRequest;
use Domain\Order\Resource\OrderResourceCollection;
use Domain\Order\Resource\OrderShowResource;

class OrderController extends Controller
{
    public function index(): OrderResourceCollection
    {
        $products = Order::all();
        return new OrderResourceCollection($products);
    }

    public function update(UpdateOrderRequest $request, Order $order): OrderShowResource
    {
        $data = $request->validated();
        $order->update($data);
        return new OrderShowResource($order);
    }
}
