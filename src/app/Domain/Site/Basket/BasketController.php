<?php

namespace Domain\Site\Basket;

use App\Http\Controllers\Controller;
use Domain\Site\Basket\Request\ChangeBasketRequest;
use Domain\Site\Basket\Resource\BasketResourceCollection;
use Illuminate\Http\JsonResponse;

class BasketController extends Controller
{
    public function index(): BasketResourceCollection
    {
        $basket = app(BasketRepository::class)->index();
        return new BasketResourceCollection($basket);
    }

    public function change(ChangeBasketRequest $request): JsonResponse
    {
        app(BasketRepository::class)->change($request->validated());
        return response()->json();
    }

    public function destroy(Basket $basket): JsonResponse
    {
        if ($basket->user_id === auth()->id()) {
            $basket->delete();
        } elseif ($basket->session_id === session()->id()) {
            $basket->delete();
        }

        return response()->json();
    }


}
