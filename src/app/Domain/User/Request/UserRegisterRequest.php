<?php

namespace Domain\User\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UserRegisterRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255|unique:users|regex:/^(\+[\d]{1,3}[- ]?)?\d{10}$/',

            'password' => 'required|string|min:6|confirmed',
        ];
    }

    protected function passedValidation(): void
    {
        $this->replace([
            'password' => Hash::make($this->password)
        ]);
    }
}
