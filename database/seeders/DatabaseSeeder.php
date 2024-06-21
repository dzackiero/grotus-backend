<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(NutritionTypeSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(UserCartSeeder::class);
        $this->call(UserSavedProductSeeder::class);
        $this->call(TransactionSeeder::class);
        $this->call(ProductRatingSeeder::class);

    }
}
