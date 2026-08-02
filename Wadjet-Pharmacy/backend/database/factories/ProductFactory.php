<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $quantity = fake()->numberBetween(1, 100);

        return [
            'category_id' => fake()->numberBetween(1, 7),
            'supplier_id' => fake()->numberBetween(1, 6),
            'admin_id' => 1,
            'name' => fake()->words(3, true),
            'description' => fake()->sentence(),
            'image' => 'https://placehold.co/400x400/007979/FFFFFF?text=' . urlencode(fake()->words(1, true)),
            'barcode' => fake()->unique()->ean13(),
            'price' => fake()->randomFloat(2, 10, 500),
            'quantity' => $quantity,
            'status' => $quantity > 0 ? 'available' : 'out_of_stock',
            'has_offer' => false,
            'offer_value' => 0,
            'start_offer' => null,
            'end_offer' => null,
        ];
    }
}
