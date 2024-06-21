<?php

namespace Database\Seeders;

use App\Models\TransactionProduct;
use Illuminate\Database\Seeder;

class ProductRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactionProducts = TransactionProduct::inRandomOrder()->take(3)->get();
        foreach ($transactionProducts as $transactionProduct) {
            $transactionProduct->giveRating(fake()->numberBetween(1, 5), fake()->boolean ? fake()->sentence : null);
        }

    }
}
