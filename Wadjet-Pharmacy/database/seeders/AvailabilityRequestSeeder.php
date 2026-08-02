<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AvailabilityRequest;
use App\Models\Customer;
use App\Models\Product;

class AvailabilityRequestSeeder extends Seeder
{
    public function run(): void
    {
        $requests = [
            ['customer_id' => 4, 'product_id' => 6, 'product_name' => null, 'notes' => null, 'status' => 'pending'],
            ['customer_id' => 5, 'product_id' => 34, 'product_name' => null, 'notes' => 'Customer needs this urgently', 'status' => 'pending'],
            ['customer_id' => 11, 'product_id' => 49, 'product_name' => null, 'notes' => 'Requested larger pack size', 'status' => 'fulfilled'],
            ['customer_id' => 11, 'product_id' => 33, 'product_name' => null, 'notes' => 'Requested larger pack size', 'status' => 'pending'],
            ['customer_id' => 7, 'product_id' => 2, 'product_name' => null, 'notes' => null, 'status' => 'fulfilled'],
            ['customer_id' => 13, 'product_id' => 20, 'product_name' => null, 'notes' => null, 'status' => 'fulfilled'],
            ['customer_id' => 4, 'product_id' => 39, 'product_name' => null, 'notes' => 'Customer needs this urgently', 'status' => 'fulfilled'],
            ['customer_id' => 12, 'product_id' => 31, 'product_name' => null, 'notes' => 'Customer needs this urgently', 'status' => 'pending'],
            ['customer_id' => 14, 'product_id' => null, 'product_name' => 'Amoxicillin 500mg Capsules', 'notes' => null, 'status' => 'pending'],
            ['customer_id' => 8, 'product_id' => null, 'product_name' => 'Metformin 850mg Tablets', 'notes' => 'Prescription item - needs pharmacist review before listing', 'status' => 'fulfilled'],
            ['customer_id' => 14, 'product_id' => null, 'product_name' => 'Insulin Pen - Rapid Acting', 'notes' => 'Prescription item - needs pharmacist review before listing', 'status' => 'pending'],
            ['customer_id' => 11, 'product_id' => null, 'product_name' => 'Blood Pressure Monitor - Digital', 'notes' => null, 'status' => 'fulfilled'],
            ['customer_id' => 13, 'product_id' => null, 'product_name' => 'Ventolin Inhaler', 'notes' => 'Prescription item - needs pharmacist review before listing', 'status' => 'pending'],
            ['customer_id' => 7, 'product_id' => null, 'product_name' => 'Vitamin K2 + D3 Drops', 'notes' => 'Checking with suppliers on availability', 'status' => 'pending'],
            ['customer_id' => 4, 'product_id' => null, 'product_name' => 'Electric Nebulizer Machine', 'notes' => 'Prescription item - needs pharmacist review before listing', 'status' => 'fulfilled'],
        ];

        foreach ($requests as $request) {
            $customer = Customer::find($request['customer_id']);

            $productName = $request['product_name'];
            if (!$productName && $request['product_id']) {
                $product = Product::find($request['product_id']);
                $productName = $product?->name ?? 'Unknown product';
            }

            AvailabilityRequest::create([
                'product_id' => $request['product_id'],
                'admin_id' => 1,
                'product_name' => $productName,
                'customer_name' => $customer->name,
                'phone' => $customer->phone,
                'address' => $customer->address,
                'notes' => $request['notes'],
                'status' => $request['status'],
                'pending' => $request['status'] === 'pending',
            ]);
        }
    }
}