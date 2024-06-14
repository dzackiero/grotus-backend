<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::createUser(
            name: "Superadmin",
            email: "admin@grotus.com",
            role: Role::Admin
        );

        for ($i = 1; $i <= 10; $i++) {
            User::createUser(
                name: "User $i",
                email: "user$i@grotus.com",
                address: fake()->address,
                birthDate: fake()->dateTimeInInterval("-20 years", "+5 years")->format("Y-m-d"),
            );
        }
    }
}
