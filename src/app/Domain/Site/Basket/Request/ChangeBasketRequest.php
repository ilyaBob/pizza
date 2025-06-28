<?php

namespace Domain\Site\Basket\Request;

use Illuminate\Foundation\Http\FormRequest;

class ChangeBasketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'quantity' => 'required|integer',
            'product_id' => 'required|int|exists:products,id',
        ];
    }
}
