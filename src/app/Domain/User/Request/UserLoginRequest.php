<?php

namespace Domain\User\Request;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone' => 'required|string|regex:/^(\+[\d]{1,3}[- ]?)?\d{10}$/',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}
