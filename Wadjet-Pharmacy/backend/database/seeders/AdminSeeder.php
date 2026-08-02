<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::firstOrCreate(
            ['email' => 'admin@wadjet.com'],
            ['name' => 'admin', 'password' => 'admin123']
        );

        Admin::firstOrCreate(
            ['email' => 'shaza.walid@wadjet-pharmacy.com'],
            ['name' => 'Shaza Walid', 'password' => 'admin123']
        );

        Admin::firstOrCreate(
            ['email' => 'fadel.ibrahim@wadjet-pharmacy.com'],
            ['name' => 'Fadel Ibrahim', 'password' => 'admin123']
        );
    }
}