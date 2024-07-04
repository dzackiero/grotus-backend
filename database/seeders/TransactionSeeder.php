<?php

namespace Database\Seeders;

use App\Enums\PaymentMethod;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::users()->get();
        foreach ($users as $user) {
            if (($user->id % 2) !== 0) {
                continue;
            }

            Transaction::createTransaction($user, collect([
                "address" => fake()->address,
                "phone" => "08123456789",
                "payment_method" => PaymentMethod::BRI,
            ]));
        }
    }
}
