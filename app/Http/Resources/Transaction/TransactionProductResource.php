<?php

namespace App\Http\Resources\Transaction;

use App\Models\ProductMedia;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/* @mixin \App\Models\TransactionProduct */
class TransactionProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $media = ProductMedia::where("product_id", $this->product_id)->first();
        return [
            "id" => $this->id,
            "product_id" => $this->product_id,
            "transaction_id" => $this->transaction_id,
            "name" => $this->name,
            "price" => $this->price,
            "amount" => $this->amount,
            "rating" => $this->rating,
            "status" => $this->whenLoaded("transaction", function () {
                return $this->transaction->status;
            }),
            "nutrition_types" => $this->product?->nutritionTypes?->map(fn($nutrition) => [
                    "id" => $nutrition->id,
                    "name" => $nutrition->name
                ]) ?? [],
            "photo" => $media ? asset($media->path) : null,
        ];
    }
}
