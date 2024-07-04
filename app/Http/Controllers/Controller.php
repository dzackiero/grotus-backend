<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function successResponse($data = null, string $message = "success"): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            "message" => $message,
            "data" => $data
        ]);
    }

    public function errorResponse(string $message = "Error occurred", $error = null, int $code = 500): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            "code" => $code,
            "message" => $message,
            "error" => $error
        ], $code);
    }
}
