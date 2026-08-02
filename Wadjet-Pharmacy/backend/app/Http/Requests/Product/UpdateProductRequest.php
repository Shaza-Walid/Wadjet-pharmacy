<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'sometimes|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'name' => 'sometimes|string',
            'description' => 'nullable|string',
            'price' => 'sometimes|numeric|min:0',
            'quantity' => 'sometimes|integer|min:0',
            'image' => 'nullable|string',
            'barcode' => 'nullable|string',
            'has_offer' => 'nullable|boolean',
            'offer_value' => 'nullable|numeric|min:0',
            'start_offer' => 'nullable|date',
            'end_offer' => 'nullable|date',
        ];
    }
}
