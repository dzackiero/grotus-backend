<?php

use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    return response()->json([
        "message" => "Welcome to Grotus API",
    ]);
});


Route::post('auth/login', [\App\Http\Controllers\AuthController::class, 'login']);
//Route::group(['middleware' => 'auth:api'], function () {
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
});

Route::delete("products/media/{media}", [\App\Http\Controllers\ProductController::class, "deleteMedia"]);
Route::group(['prefix' => 'products'], function () {
    Route::get("/", [\App\Http\Controllers\ProductController::class, "index"]);
    Route::post("/", [\App\Http\Controllers\ProductController::class, "store"]);
    Route::get("/{product}", [\App\Http\Controllers\ProductController::class, "show"]);
    Route::post("/{product}", [\App\Http\Controllers\ProductController::class, "update"]);
    Route::delete("/{product}", [\App\Http\Controllers\ProductController::class, "destroy"]);
});

//});
