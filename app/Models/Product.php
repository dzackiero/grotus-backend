<?php

namespace App\Models;

use App\Interfaces\HasImage;
use App\Traits\InteractWithImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model implements HasImage
{
    use HasFactory, InteractWithImage;

    protected $guarded = [];

    /* RELATIONSHIP */

    public function medias(): HasMany
    {
        return $this->hasMany(ProductMedia::class, "product_id");
    }

    public function nutritionTypes(): BelongsToMany
    {
        return $this->belongsToMany(NutritionType::class);
    }

    /* STUBS */

    public function getImageSize(): array
    {
        return [
            "width" => 640,
            "height" => 640,
            "ratio" => 1
        ];
    }

    public function uploadImageCallback($path): bool
    {
        $product = ProductMedia::create([
            "product_id" => $this->id,
            "path" => $path,
        ]);

        return (bool)$product;
    }

    /* METHODS */

    public static function createProduct(
        iterable $productData,
        ?array   $images = null,
        ?array   $nutritionTypes = null
    ): Product
    {
        $product = Product::create($productData);
        $product->nutritionTypes()->attach($nutritionTypes);

        if ($images) {
            $product->uploadMedia($images);
        }

        return $product;
    }

    public function updateProduct(
        iterable $productData,
        ?array   $images = null,
        ?array   $nutritionTypes = null
    ): Product
    {
        $product = Product::create($productData);
        $product->nutritionTypes()->sync($nutritionTypes);

        if ($images) {
            $product->uploadMedia($images);
        }

        return $product;
    }

    public function uploadMedia(array $images): void
    {
        foreach ($images as $key => $image) {
            $this->uploadImage($image, "product", str("$this->name-$key")->slug("_"));
        }
    }

}
