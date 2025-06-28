<?php

namespace Domain\Site\Basket;

use App\Exceptions\BusinessLogicException;
use Domain\Product\Enum\ProductTypeEnum;
use Domain\Product\Product;
use Illuminate\Database\Eloquent\Collection;

class BasketRepository
{
    public function index(): Collection
    {
        $user = ['user_id' => auth()->id()];
        $session = ['session_id' => session()->getId()];

        $auth = auth()->id() ? $user : $session;

        return Basket::query()->when(auth()->id(), function ($query) use ($auth) {
            $query->where('user_id', $auth);
        }, function ($query) use ($auth) {
            $query->where('session_id', $auth);
        })->where('is_active', true)->get();

    }

    public function change($data): void
    {
        $product = Product::query()->findOrFail($data['product_id']);

        $data = [
            'price' => $product->price,
            'user_id' => auth()->id(),
            'session_id' => session()->getId(),
            'quantity' => $data['quantity'],
            'product_id' => $data['product_id'],
        ];

        $user = ['user_id' => auth()->id()];
        $session = ['session_id' => session()->getId()];

        $auth = auth()->id() ? $user : $session;

        $this->checkAmount($auth, $data['quantity'], $product->id);

        Basket::query()->updateOrCreate([
            ...$auth,
            'product_id' => $product->id,
            'is_active' => true
        ], $data);
    }

    public function checkAmount(array $auth, int $amount, int $productId)
    {
        $userBasket = Basket::query()->when(auth()->id(), function ($query) use ($auth) {
            $query->where('user_id', $auth);
        }, function ($query) use ($auth) {
            $query->where('session_id', $auth);
        })
            ->where('is_active', true)
            ->where('product_id', '!=', $productId)
            ->join('products', 'baskets.product_id', '=', 'products.id')
            ->select('baskets.*', 'products.type')
            ->get()
            ->groupBy('type');

        $productAmountByType = $userBasket->map(function ($item) use ($auth) {
            return $item->sum('quantity');
        });

        foreach ($productAmountByType as $type => $amountSum) {
            $res = $amountSum + $amount;
            if ($type === ProductTypeEnum::PIZZA->value) {
                if ($res > 10) {
                    throw new BusinessLogicException('Вы не можете добавить больше 10 пицц.');
                }
            }
            if ($type === ProductTypeEnum::DRINK->value) {
                if ($res > 20) {
                    throw new BusinessLogicException('Вы не можете добавить больше 20 напитков.');
                }
            }
        }

    }
}
