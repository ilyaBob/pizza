<?php

namespace Domain\Product\Request;

use Illuminate\Foundation\Http\FormRequest;

class AbstractProductRequest extends FormRequest
{

    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'price' => 'required|integer|min:1',
        ];
    }
}
