<?php

namespace Domain\Site\Order;

use App\Http\Controllers\Controller;
use Domain\Order\Enum\OrderStatusEnum;
use Domain\Order\Order;
use Domain\Site\Order\Resource\OrderResource;
use Domain\Site\Order\Resource\OrderResourceCollection;
use Domain\Site\Order\Request\StoreOrderRequest;

class OrderController extends Controller
{
    public function index(): OrderResourceCollection
    {
        $orders = auth()->user()->orders;
        return new OrderResourceCollection($orders);
    }

    public function store(StoreOrderRequest $request): OrderResource
    {
        $data = $request->validated();
        $data['status_id'] = OrderStatusEnum::IN_PROGRESS->value;
        $data['user_id'] = auth()->id();

        $order = Order::create($data);
        return new OrderResource($order);
    }
}
