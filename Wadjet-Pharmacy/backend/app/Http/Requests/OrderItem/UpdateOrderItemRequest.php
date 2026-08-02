<?php

namespace App\Http\Requests\OrderItem;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'order_id' => 'sometimes|exists:orders,order_id',
            'product_id' => 'sometimes|exists:products,product_id',
            'quantity' => 'sometimes|integer|min:1',
            'unit_price' => 'sometimes|numeric|min:0',
        ];
    }
}
