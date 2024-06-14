<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function successResponse($data, string $message = "success"): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            "message" => $message,
            "data" => $data
        ]);
    }
}
