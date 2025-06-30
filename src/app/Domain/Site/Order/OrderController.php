<?php

namespace Domain\Site\Order;

use App\Http\Controllers\Controller;
use Domain\Order\Enum\OrderStatusEnum;
use Domain\Order\Order;
use Domain\Site\Order\Resource\OrderResource;
use Domain\Site\Order\Resource\OrderResourceCollection;
use Domain\Site\Order\Request\StoreOrderRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(): OrderResourceCollection
    {
        $orders = auth()->user()->orders;
        return new OrderResourceCollection($orders);
    }

    public function store(StoreOrderRequest $request): OrderResource|JsonResponse
    {
        $user = auth()->user();
        $data = $request->validated();
        $data['status_id'] = OrderStatusEnum::IN_PROGRESS->value;
        $data['user_id'] = $user->id;

        try {
            DB::beginTransaction();
            $order = Order::create($data);
            $user->basket()->whereNull('order_id')->update(['order_id' => $order->id]);
            DB::commit();

        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => $exception->getMessage()], 400);
        }

        return new OrderResource($order);
    }
}
