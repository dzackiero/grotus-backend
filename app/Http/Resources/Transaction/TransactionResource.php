<?php

namespace App\Http\Resources\Transaction;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/* @mixin \App\Models\Transaction */
class TransactionResource extends JsonResource
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
            "name" => $this->name,
            "address" => $this->address,
            "phone_number" => $this->phone_number,
            "payment_method" => $this->payment_method,
            "products" => $this->whenLoaded("transactionProducts", function () {
                return $this->transactionProduct;
            })
        ];
    }
}
