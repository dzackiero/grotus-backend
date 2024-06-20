<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    /* RELATIONSHIP */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactionProducts(): HasMany
    {
        return $this->hasMany(TransactionProduct::class);
    }

    /* METHODS */

    public static function createTransaction(User $user): Transaction
    {
        if ($user->cartItems()->doesntExist()) {
            throw new \Exception("No Item on this user cart", 422);
        }

        $profile = $user->profile;
        $transaction = Transaction::create([
            "user_id" => $user->id,
            "name" => $profile->name,
            "address" => $profile->address ?? '',
            "phone_number" => $profile->phone ?? '',
            "payment_method" => $profile->preferred_payment,
        ]);

        $cartItems = $user->cartItems;
        foreach ($cartItems as $item) {
            $transaction->addProduct($item);
        }

        return $transaction;
    }

    public function addProduct(UserCart $item): TransactionProduct
    {
        $transactionProduct = TransactionProduct::create([
            "transaction_id" => $this->id,
            "product_id" => $item->product_id,
            "rating_id" => null,
            "price" => $item->product->price,
            "amount" => $item->amount,
        ]);

        $item->delete();

        return $transactionProduct;
    }
}