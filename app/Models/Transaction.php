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
        return $this->hasMany(TransactionProduct::class, "transaction_id");
    }

    /* METHODS */

    /**
     * @param User $user
     * @param array{address: string, phone: string, payment_method: string} $transactionData
     * @return Transaction
     * @throws \Exception
     */
    public static function createTransaction(User $user, array $transactionData): Transaction
    {
        if ($user->cartItems()->doesntExist()) {
            throw new \Exception("No Item on this user cart", 422);
        }

        $profile = $user->profile;
        $transaction = Transaction::create([
            "user_id" => $user->id,
            "name" => $profile->name,
            "address" => $transactionData["address"],
            "phone" => $transactionData["phone"],
            "payment_method" => $transactionData["payment_method"],
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
