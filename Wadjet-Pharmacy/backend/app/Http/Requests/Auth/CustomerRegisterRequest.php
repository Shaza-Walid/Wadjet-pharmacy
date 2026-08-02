<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:customers,email',
            'phone' => ['required', 'regex:/^01[0125][0-9]{8}$/'],
            'address' => 'required|string',
            'password' => 'required|min:6|confirmed',
        ];
    }
}
