<?php

namespace App\Http\Resources\Transaction;

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
        return [
            "id" => $this->id,
            "product_id" => $this->product_id,
            "name" => $this->name,
            "price" => $this->price,
            "amount" => $this->amount,
            "rating" => $this->rating,
            "photo" => $this->whenLoaded("medias", function () {
                if ($media = $this->medias()->first()) {
                    return asset($media->path);
                }
                return null;
            }
            ),
        ];
    }
}
