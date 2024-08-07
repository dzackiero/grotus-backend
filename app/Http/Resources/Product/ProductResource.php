<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/* @mixin \App\Models\Product */
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $ratings = $this->ratings;
        return [
            "id" => $this->id,
            "name" => $this->name,
            "price" => $this->price,
            "stock" => $this->stock,
            "description" => $this->description,
            "metadata" => $this->metadata,
            "photo" => $this->whenLoaded("medias", function () {
                if ($media = $this->medias()->first()) {
                    return asset($media->path);
                }
                return null;
            }
            ),
            "ratings_average" => $ratings->avg("rating") ?? 0,
            "ratings_count" => $ratings->count(),
            "nutrition_types" => $this->nutritionTypes?->map(fn($nutrition) => ["id" => $nutrition->id, "name" => $nutrition->name]) ?? [],
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
