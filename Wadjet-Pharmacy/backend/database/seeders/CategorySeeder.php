<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Pain Relief & Fever Reducers', 'description' => 'Over-the-counter pain relief and fever reduction products'],
            ['name' => 'Vitamins & Supplements', 'description' => 'Vitamins, minerals and dietary supplements for adults and kids'],
            ['name' => 'Skincare', 'description' => 'Daily moisturizing, cleansing and skin care products'],
            ['name' => 'Hair Care', 'description' => 'Shampoos, conditioners and hair oils'],
            ['name' => 'Oral Care', 'description' => 'Toothpaste, mouthwash and dental hygiene products'],
            ['name' => 'Baby Care', 'description' => 'Everyday care products for babies and infants'],
            ['name' => 'Cold & Flu', 'description' => 'Over-the-counter cold and flu symptom relief products'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}