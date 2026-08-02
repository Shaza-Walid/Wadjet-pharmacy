<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Customer;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $orders = [
            ['customer_id' => 5, 'status' => 'pending', 'notes' => null, 'items' => [
                ['product_id' => 36, 'quantity' => 3, 'unit_price' => 75.00],
                ['product_id' => 54, 'quantity' => 2, 'unit_price' => 18.00],
                ['product_id' => 6, 'quantity' => 1, 'unit_price' => 9.75],
            ]],
            ['customer_id' => 9, 'status' => 'pending', 'notes' => 'Please deliver after 5 PM', 'items' => [
                ['product_id' => 55, 'quantity' => 2, 'unit_price' => 55.00],
            ]],
            ['customer_id' => 7, 'status' => 'delivered', 'notes' => 'Leave with doorman if not home', 'items' => [
                ['product_id' => 50, 'quantity' => 2, 'unit_price' => 25.00],
                ['product_id' => 44, 'quantity' => 2, 'unit_price' => 180.00],
            ]],
            ['customer_id' => 2, 'status' => 'pending', 'notes' => null, 'items' => [
                ['product_id' => 46, 'quantity' => 1, 'unit_price' => 45.00],
                ['product_id' => 7, 'quantity' => 1, 'unit_price' => 26.50],
            ]],
            ['customer_id' => 8, 'status' => 'delivered', 'notes' => null, 'items' => [
                ['product_id' => 33, 'quantity' => 1, 'unit_price' => 65.00],
                ['product_id' => 13, 'quantity' => 2, 'unit_price' => 110.00],
                ['product_id' => 47, 'quantity' => 3, 'unit_price' => 220.00],
                ['product_id' => 50, 'quantity' => 2, 'unit_price' => 25.00],
            ]],
            ['customer_id' => 11, 'status' => 'delivered', 'notes' => 'Please deliver after 5 PM', 'items' => [
                ['product_id' => 1, 'quantity' => 2, 'unit_price' => 12.50],
                ['product_id' => 50, 'quantity' => 2, 'unit_price' => 25.00],
                ['product_id' => 40, 'quantity' => 2, 'unit_price' => 20.00],
            ]],
            ['customer_id' => 3, 'status' => 'delivered', 'notes' => 'Call before delivery', 'items' => [
                ['product_id' => 38, 'quantity' => 1, 'unit_price' => 35.00],
                ['product_id' => 3, 'quantity' => 2, 'unit_price' => 15.00],
            ]],
            ['customer_id' => 12, 'status' => 'pending', 'notes' => 'Please deliver after 5 PM', 'items' => [
                ['product_id' => 48, 'quantity' => 3, 'unit_price' => 38.00],
                ['product_id' => 3, 'quantity' => 3, 'unit_price' => 15.00],
            ]],
            ['customer_id' => 3, 'status' => 'delivered', 'notes' => 'Call before delivery', 'items' => [
                ['product_id' => 5, 'quantity' => 1, 'unit_price' => 22.00],
                ['product_id' => 56, 'quantity' => 2, 'unit_price' => 22.00],
                ['product_id' => 55, 'quantity' => 3, 'unit_price' => 55.00],
            ]],
        ];

        foreach ($orders as $orderData) {
            $customer = Customer::find($orderData['customer_id']);

            $order = Order::create([
                'customer_id' => $customer->customer_id,
                'customer_name' => $customer->name,
                'phone' => $customer->phone,
                'address' => $customer->address,
                'notes' => $orderData['notes'],
                'status' => $orderData['status'],
                'pending' => $orderData['status'] !== 'cancelled',
                'cancelled' => false,
            ]);

            foreach ($orderData['items'] as $item) {
                OrderItem::create([
                    'order_id' => $order->order_id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'subtotal' => $item['quantity'] * $item['unit_price'],
                ]);
            }
        }
    }
}