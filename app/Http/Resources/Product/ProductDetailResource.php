<?php

namespace App\Http\Resources\Product;

use App\Models\ProductMedia;
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
        return [
            "id" => $this->id,
            "name" => $this->name,
            "price" => $this->price,
            "stock" => $this->stock,
            "description" => $this->description,
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
        ];
    }
}
