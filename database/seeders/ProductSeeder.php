<?php

namespace Database\Seeders;

use App\Models\NutritionType;
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
            $product = Product::createProduct([
                "name" => "Product $i",
                "price" => fake()->numberBetween(0, 1_000_000),
                "stock" => fake()->numberBetween(0, 100),
                "description" => fake()->sentences(asText: true),
                "metadata" => fake()->sentences(10, true),
            ]);

            $nutrition = NutritionType::inRandomOrder()->take(fake()->numberBetween(1, 3))->get();
            $nutrition = $nutrition->pluck("id")->toArray();
            $product->nutritionTypes()->attach($nutrition);
        }
    }
}
