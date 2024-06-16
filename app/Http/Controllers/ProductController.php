<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Cart\CartItemResource;
use App\Http\Resources\Product\ProductDetailResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Models\ProductMedia;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->query("page", 1);
        $perPage = $request->query("perPage", 10);

        $data = QueryBuilder::for(Product::class)->with(["medias"])
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
    public function store(StoreProductRequest $request)
    {
        $data = $request->except("images");

        $product = Product::createProduct($data, $request->file("images"));

        $data = new ProductResource($product);
        return $this->successResponse($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product = $product->with(["medias"])->find($product->id);
        $data = new ProductDetailResource($product);

        return $this->successResponse($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): \Illuminate\Http\JsonResponse
    {
        $data = $request->except("images");
        $product->update($data);

        if ($images = $request->file("images")) {
            $product->uploadMedia($images);
        }

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

    public function addToCart(Product $product): \Illuminate\Http\JsonResponse
    {
        $user = User::find(auth()->user()->id);
        $user->addToCart($product);

        $carts = CartItemResource::collection($user->cartItems);
        return $this->successResponse($carts);
    }

    public function addToWishlist(Product $product): \Illuminate\Http\JsonResponse
    {
        $user = User::find(auth()->user()->id);
        $user->addToWishlist($product);

        $carts = CartItemResource::collection($user->cartItems);
        return $this->successResponse($carts);
    }
}
