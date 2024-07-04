<?php

use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    return response()->json([
        "message" => "Welcome to Grotus API",
    ]);
})->name("api");


Route::post('auth/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('auth/register', [\App\Http\Controllers\AuthController::class, 'register']);

Route::group(["prefix" => "products"], function () {
    Route::get("/", [\App\Http\Controllers\ProductController::class, "index"]);
    Route::get("/{product}", [\App\Http\Controllers\ProductController::class, "show"]);
});

Route::group(["prefix" => "nutrition-types"], function () {
    Route::get("/", [\App\Http\Controllers\NutritionTypeController::class, "index"]);
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
        Route::post('refresh', [\App\Http\Controllers\AuthController::class, 'refresh']);
        Route::post('me', [\App\Http\Controllers\AuthController::class, 'me']);
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get("/", [\App\Http\Controllers\UserController::class, "index"]);
        Route::post("/", [\App\Http\Controllers\UserController::class, "store"]);
        Route::get("/{user}", [\App\Http\Controllers\UserController::class, "show"]);
        Route::post("/{user}", [\App\Http\Controllers\UserController::class, "update"]);
        Route::delete("/{user}", [\App\Http\Controllers\UserController::class, "destroy"]);
        Route::get("/{user}/cart", [\App\Http\Controllers\UserController::class, "userCart"]);
        Route::get("/{user}/wishlist", [\App\Http\Controllers\UserController::class, "userWishlist"]);
    });

    Route::group(['prefix' => 'cart'], function () {
        Route::put("/{cartItem}", [\App\Http\Controllers\UserController::class, "updateCartItem"]);
        Route::delete("/{cartItem}", [\App\Http\Controllers\UserController::class, "deleteCartItem"]);
    });

    Route::group(['prefix' => 'wishlist'], function () {
        Route::delete("/{wishlistItem}", [\App\Http\Controllers\UserController::class, "deleteWishlistItem"]);
    });

    Route::delete("products/media/{media}", [\App\Http\Controllers\ProductController::class, "deleteMedia"]);
    Route::group(['prefix' => 'products'], function () {
        Route::post("/", [\App\Http\Controllers\ProductController::class, "store"]);
        Route::post("/{product}", [\App\Http\Controllers\ProductController::class, "update"]);
        Route::delete("/{product}", [\App\Http\Controllers\ProductController::class, "destroy"]);
        Route::post("/{product}/cart", [\App\Http\Controllers\ProductController::class, "addToCart"]);
        Route::post("/{product}/wishlist", [\App\Http\Controllers\ProductController::class, "addToWishlist"]);
    });

    Route::group(['prefix' => 'transactions'], function () {
        Route::get("/", [\App\Http\Controllers\TransactionController::class, "index"]);
        Route::post("/", [\App\Http\Controllers\TransactionController::class, "store"]);
        Route::get("/{transaction}", [\App\Http\Controllers\TransactionController::class, "show"]);
        Route::put("/{transaction}/pay", [\App\Http\Controllers\TransactionController::class, "payment"]);
        Route::delete("/{transaction}", [\App\Http\Controllers\TransactionController::class, "destroy"]);
    });

    Route::group(['prefix' => 'transaction-products'], function () {
        Route::get("/", [\App\Http\Controllers\TransactionProductController::class, "index"]);
        Route::get("/{transactionProduct}", [\App\Http\Controllers\TransactionProductController::class, "show"]);
        Route::put("/{transactionProduct}", [\App\Http\Controllers\TransactionProductController::class, "rate"]);
    });

    Route::group(["prefix" => "nutrition-types"], function () {
        Route::post("/", [\App\Http\Controllers\NutritionTypeController::class, "store"]);
        Route::get("/{nutritionType}", [\App\Http\Controllers\NutritionTypeController::class, "show"]);
        Route::patch("/{nutritionType}", [\App\Http\Controllers\NutritionTypeController::class, "update"]);
        Route::delete("/{nutritionType}", [\App\Http\Controllers\NutritionTypeController::class, "delete"]);
    });

});
