<?php

namespace App\Models;

use App\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

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
     * @param Collection{address: string, phone: string, payment_method: string} $transactionData
     * @return Transaction
     * @throws \Exception
     */
    public static function createTransaction(User $user, Collection $transactionData): Transaction
    {
        if ($user->cartItems()->doesntExist()) {
            throw new \Exception("No Item on this user cart", 422);
        }

        $profile = $user->profile;
        $transaction = Transaction::create([
            "user_id" => $user->id,
            "name" => $profile->name,
            "address" => $transactionData->get("address"),
            "phone" => $transactionData->get("phone"),
            "payment_method" => $transactionData->get("payment_method"),
            "delivery_method" => $transactionData->get("delivery_method"),
            "status" => TransactionStatus::WAITING_PAYMENT
        ]);

        $cartItems = $user->cartItems;
        foreach ($cartItems as $item) {
            $transaction->addProduct($item);
        }

        return $transaction;
    }

    public function addProduct(UserCart $item): TransactionProduct
    {
        $product = $item->product;
        $transactionProduct = TransactionProduct::create([
            "transaction_id" => $this->id,
            "product_id" => $item->product_id,
            "rating_id" => null,
            "name" => $product->name,
            "price" => $product->price,
            "amount" => $item->amount,
        ]);

        $item->delete();

        return $transactionProduct;
    }
}
