<?php

namespace App\Http\Controllers;

use App\Http\Requests\NutritionType\StoreNutritionTypeRequest;
use App\Models\NutritionType;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class NutritionTypeController extends Controller
{
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $page = $request->query("page", 1);
        $perPage = $request->query("perPage", 10);
        $sortBy = $request->query("sortBy", "created_at");
        $direction = $request->query("direction", "asc");

        $query = QueryBuilder::for(NutritionType::class);

        $data = $query->orderBy($sortBy, $direction)
            ->paginate(perPage: $perPage, page: $page);
        return $this->successResponse($data);
    }

    public function store(StoreNutritionTypeRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $data = NutritionType::create($data);

        return $this->successResponse($data->refresh());
    }

    public function show(NutritionType $nutritionType): \Illuminate\Http\JsonResponse
    {
        return $this->successResponse($nutritionType);
    }

    public function update(StoreNutritionTypeRequest $request, NutritionType $nutritionType): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $nutritionType->update($data);

        return $this->successResponse($nutritionType->refresh());
    }

    public function delete(NutritionType $nutritionType): \Illuminate\Http\JsonResponse
    {
        $isProductExist = $nutritionType->products()->exists();
        if ($isProductExist) {
            return $this->errorResponse("Nutrition Type cannot be deleted because it's used by product(s)", code: 422);
        }

        $nutritionType->delete();
        return $this->successResponse();
    }
}
