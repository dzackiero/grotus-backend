<?php

namespace App\Http\Resources\Product;

use App\Models\ProductMedia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/* @mixin \App\Models\Product */
class  ProductDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = User::find(auth()->user()?->id);
        $isSaved = $user && $user->savedProduct()->where("product_id", $this->id)->exists();
        $ratings = $this->ratings;

        return [
            "id" => $this->id,
            "name" => $this->name,
            "price" => $this->price,
            "stock" => $this->stock,
            "description" => $this->description,
            "saved" => $isSaved,
            "metadata" => $this->metadata,
            "nutrition_types" => $this->nutritionTypes?->map(fn($nutrition) => ["id" => $nutrition->id, "name" => $nutrition->name]) ?? [],
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
            "ratings_average" => $ratings->avg("rating") ?? 0,
            "ratings_count" => $ratings->count(),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
