<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductMedia extends Model
{
    use HasFactory;

    protected $guarded = [];

    /* RELATIONSHIP */

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
