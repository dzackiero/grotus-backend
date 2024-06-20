<?php

namespace App\Http\Resources\Product;

use App\Models\ProductMedia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/* @mixin \App\Models\Product */
class ProductDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = User::find(auth()->user()->id);
        $isSaved = (bool)$user?->savedProduct()->where("product_id", $this->id)->exists();
        return [
            "id" => $this->id,
            "name" => $this->name,
            "price" => $this->price,
            "stock" => $this->stock,
            "description" => $this->description,
            "saved" => $isSaved,
            "photos" => $this->whenLoaded("medias", function () {
                if ($this->medias()->exists()) {
                    return $this->medias->map(fn(ProductMedia $media) => [
                        "id" => $media->id,
                        "image" => asset($media->path),
                    ]);
                }
                return null;
            }
            ),
            
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
