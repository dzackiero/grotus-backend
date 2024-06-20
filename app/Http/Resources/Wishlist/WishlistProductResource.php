<?php

namespace App\Http\Resources\Wishlist;

use App\Http\Resources\Product\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/* @mixin \App\Models\UserSavedProduct */
class WishlistProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "product" => new ProductResource($this->product),
        ];
    }
}
