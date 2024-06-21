<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TransactionProduct extends Model
{
    use HasFactory;

    protected $guarded = [];

    /* RELATIONSHIP */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function rating(): BelongsTo
    {
        return $this->belongsTo(ProductRating::class, "rating_id");
    }

    public function medias(): HasMany
    {
        return $this->hasMany(ProductMedia::class, "product_id", "product_id");
    }

    /* METHODS */


    public function giveRating(int $rating, string $description = null): TransactionProduct
    {
        $transaction = $this->transaction;
        $productRating = ProductRating::create([
            "user_id" => $transaction->user_id,
            "product_id" => $this->product_id,
            "rating" => $rating,
            "description" => $description,
        ]);

        $this->update([
            "rating_id" => $productRating->id,
        ]);

        return $this;
    }
}
