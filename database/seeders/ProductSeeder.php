<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Product::createProduct([
                "name" => "Product $i",
                "price" => fake()->numberBetween(0, 1_000_000),
                "stock" => fake()->numberBetween(0, 100),
                "description" => fake()->sentences(asText: true),
            ]);
        }
    }
}
