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

    Route::apiResource("users", \App\Http\Controllers\UserController::class);
//});
