<?php

namespace Domain\Site\Order\Request;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone' => 'required|string|regex:/^(\+[\d]{1,3}[- ]?)?\d{10}$/',
            'email' => 'nullable|string|email|max:255',
            'address' => 'required|string',
            'time_delivery' => 'required|string|date_format:Y-m-d H:i',
        ];
    }
}
