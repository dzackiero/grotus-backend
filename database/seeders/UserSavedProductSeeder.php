<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSavedProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where("role", Role::User->value)->get();
        foreach ($users as $user) {
            $user->addToWishlist(Product::inRandomOrder()->first());
        }
    }
}
