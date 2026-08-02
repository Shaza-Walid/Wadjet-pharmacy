<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            ['name' => 'Delta Pharma Distribution', 'phone' => '0223456701', 'email' => 'sales@deltapharma-eg.com', 'address' => '10th of Ramadan City, Industrial Zone A, Egypt'],
            ['name' => 'Nile Health Supplies', 'phone' => '0223456702', 'email' => 'info@nilehealth-eg.com', 'address' => '6th of October City, Egypt'],
            ['name' => 'Cairo Care Trading', 'phone' => '0223456703', 'email' => 'contact@cairocare-eg.com', 'address' => 'Nasr City, Cairo, Egypt'],
            ['name' => 'Alexandria Wellness Co.', 'phone' => '0334567890', 'email' => 'orders@alexwellness-eg.com', 'address' => 'Smouha, Alexandria, Egypt'],
            ['name' => 'MediBaby Egypt', 'phone' => '0223456705', 'email' => 'support@medibaby-eg.com', 'address' => 'Maadi, Cairo, Egypt'],
            ['name' => 'PureSkin Distributors', 'phone' => '0223456706', 'email' => 'hello@pureskin-eg.com', 'address' => 'Sheikh Zayed, Giza, Egypt'],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}