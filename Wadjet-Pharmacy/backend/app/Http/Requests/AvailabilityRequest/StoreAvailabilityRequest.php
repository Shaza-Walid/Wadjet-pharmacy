<?php

namespace App\Http\Requests\AvailabilityRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreAvailabilityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => 'nullable|exists:products,product_id',
            'product_name' => 'required|string',
            'customer_name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'nullable|string',
            'notes' => 'nullable|string',
        ];
    }
}
