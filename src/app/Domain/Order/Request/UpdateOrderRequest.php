<?php

namespace Domain\Order\Request;

use Domain\Order\Enum\OrderStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        $types = OrderStatusEnum::getValuesString();

        return [
            'status_id' => 'required|integer|in:' . $types,
        ];
    }
}
