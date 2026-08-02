<?php

namespace App\Services\OrderItem;

use App\Models\OrderItem;

class OrderItemService
{
    public function getAllOrderItems()
    {
        return OrderItem::with('product')->get();
    }

    public function getOrderItem(string $id)
    {
        return OrderItem::with('product')->find($id);
    }

    public function createOrderItem(array $data)
    {
        $subtotal = $data['quantity'] * $data['unit_price'];

        return OrderItem::create([
            ...$data,
            'subtotal' => $subtotal,
        ]);
    }

    public function updateOrderItem(string $id, array $data)
    {
        $orderItem = OrderItem::find($id);

        if (!$orderItem) {
            return null;
        }

        $orderItem->update($data);

        if (isset($data['quantity']) || isset($data['unit_price'])) {
            $quantity = $data['quantity'] ?? $orderItem->quantity;
            $unitPrice = $data['unit_price'] ?? $orderItem->unit_price;
            $orderItem->subtotal = $quantity * $unitPrice;
            $orderItem->save();
        }

        return $orderItem;
    }

    public function deleteOrderItem(string $id)
    {
        $orderItem = OrderItem::find($id);

        if (!$orderItem) {
            return false;
        }

        $orderItem->delete();
        return true;
    }
}
