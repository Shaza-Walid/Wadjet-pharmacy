<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|string',
            'barcode' => 'nullable|string',
            'has_offer' => 'nullable|boolean',
            'offer_value' => 'nullable|numeric|min:0',
            'start_offer' => 'nullable|date',
            'end_offer' => 'nullable|date',
        ];
    }
}
