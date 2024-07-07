<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\AddToCartRequest;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Cart\CartItemResource;
use App\Http\Resources\Product\ProductDetailResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Models\ProductMedia;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $page = $request->query("page", 1);
        $perPage = $request->query("perPage", 10);
        $sortBy = $request->query("sortBy", "created_at");
        $direction = $request->query("direction", "desc");

        $data = QueryBuilder::for(Product::class)->with(["medias", "ratings"])
            ->selectRaw("products.id, name, price, stock, products.description, metadata,
            AVG(rating) AS ratings_average, COUNT(rating) as ratings_count,
            products.created_at, products.updated_at")
            ->leftJoin("product_ratings", "products.id", "=", "product_ratings.product_id")
            ->allowedFilters([
                AllowedFilter::partial("search", "name"),
                AllowedFilter::callback("nutrition", function (Builder $query, $name) {
                    $query->whereHas("nutritionTypes", function (Builder $query) use ($name) {
                        $query->where(\DB::raw('LOWER(name)'), "LIKE", '%' . strtolower($name) . '%');
                    });
                }),
            ])
            ->orderBy($sortBy, $direction)
            ->groupBy(["products.id", "name", "price", "stock", "products.description", "metadata"])
            ->paginate(
                perPage: $perPage,
                page: $page,
            );

        $data = ProductResource::collection($data);
        return $this->successResponse($data->resource);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->except(["images", "nutrition_types"]);

        $product = Product::createProduct($data, $request->file("images"), $request->input("nutrition_types"));

        $data = new ProductDetailResource($product->with("medias")->find($product->id));
        return $this->successResponse($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): \Illuminate\Http\JsonResponse
    {
        $product = $product->with(["medias", "ratings"])->find($product->id);
        $data = new ProductDetailResource($product);

        return $this->successResponse($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): \Illuminate\Http\JsonResponse
    {
        $data = $request->except(["images", "nutrition_types"]);
        $product->updateProduct($data, $request->file("images"), $request->input("nutrition_types"));

        $data = new ProductDetailResource($product->with("medias")->find($product->id));
        return $this->successResponse($data);
    }

    /*
     * Delete Media
     *
     */
    public function deleteMedia(ProductMedia $media): \Illuminate\Http\JsonResponse
    {
        $media->deleteOrFail();
        return $this->successResponse();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->deleteOrFail();
        return $this->successResponse();
    }

    /* CART */

    public function addToCart(AddToCartRequest $request, Product $product): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $user = User::find(auth()->user()->id);
        $user->addToCart($product, $data["amount"]);

        $carts = CartItemResource::collection($user->cartItems);
        return $this->successResponse($carts);
    }

    public function addToWishlist(Product $product): \Illuminate\Http\JsonResponse
    {
        $user = User::find(auth()->user()->id);
        $user->addToWishlist($product);

        $carts = CartItemResource::collection($user->savedProduct()->with("product")->get());
        return $this->successResponse($carts);
    }
}
