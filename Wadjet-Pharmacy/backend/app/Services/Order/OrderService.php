<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderService
{
    public function getAllOrders()
    {
        return Order::with('items.product')->get();
    }

    public function getOrder(string $id)
    {
        return Order::with('items.product')->find($id);
    }

    public function createOrder(array $data)
    {
        return DB::transaction(function () use ($data) {
            $order = Order::create([
                'customer_id' => $data['customer_id'] ?? null,
                'customer_name' => $data['customer_name'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'notes' => $data['notes'] ?? null,
                'status' => 'pending',
                'pending' => true,
                'cancelled' => false,
            ]);

            foreach ($data['items'] as $item) {
                $product = Product::findOrFail($item['product_id']);

                if ($product->quantity < $item['quantity']) {
                    throw ValidationException::withMessages([
                        'items' => ["Insufficient stock for product: {$product->name}"],
                    ]);
                }

                OrderItem::create([
                    'order_id' => $order->order_id,
                    'product_id' => $product->product_id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->price,
                    'subtotal' => $product->price * $item['quantity'],
                ]);

                $product->decrement('quantity', $item['quantity']);

                if ($product->quantity <= 0) {
                    $product->update(['status' => 'out_of_stock']);
                }
            }

            return $order;
        });
    }

    public function updateOrderStatus(string $id, array $data)
    {
        $order = Order::with('items.product')->find($id);

        if (!$order) {
            return null;
        }

        $wasCancelled = $order->status === 'cancelled';
        $isNowCancelled = $data['status'] === 'cancelled';

        if ($isNowCancelled && !$wasCancelled) {
            foreach ($order->items as $item) {
                $product = $item->product;
                $product->increment('quantity', $item->quantity);
                $product->update(['status' => 'available']);
            }
        }

        $order->status = $data['status'];
        $order->pending = $data['status'] !== 'cancelled';
        $order->cancelled = $isNowCancelled;
        $order->save();

        return $order;
    }
}
