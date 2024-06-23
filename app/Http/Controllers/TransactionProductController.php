<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaction\RateTransactionProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Transaction\TransactionProductResource;
use App\Models\TransactionProduct;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TransactionProductController extends Controller
{
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $page = $request->query("page", 1);
        $perPage = $request->query("perPage", 10);
        $sortBy = $request->query("sortBy", "created_at");
        $direction = $request->query("direction", "asc");

        $data = QueryBuilder::for(TransactionProduct::class)->with(["medias"])
            ->whereHas("transaction", function (Builder $query) {
                $query->whereNotNull("paid_at");
            })
            ->allowedFilters([
                AllowedFilter::partial("search", "name"),
            ])
            ->orderBy($sortBy, $direction)
            ->paginate(
                perPage: $perPage,
                page: $page,
            );

        $data = ProductResource::collection($data);
        return $this->successResponse($data->resource);
    }

    public function show(TransactionProduct $transactionProduct): \Illuminate\Http\JsonResponse
    {
        $transactionProduct = $transactionProduct->with(["medias"])->find($transactionProduct->id);
        $data = new TransactionProductResource($transactionProduct);

        return $this->successResponse($data);
    }

    public function rate(RateTransactionProductRequest $request, TransactionProduct $transactionProduct): \Illuminate\Http\JsonResponse
    {
        if ($transactionProduct->rating_id) {
            return $this->errorResponse("Product already rated", code: 422);
        }

        $data = $request->validated();
        $transactionProduct->giveRating($data["rating"], $data["description"] ?? null);

        return $this->successResponse($transactionProduct->refresh());
    }
}
