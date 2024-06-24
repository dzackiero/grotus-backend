<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Requests\Transaction\PaymentTransactionRequest;
use App\Http\Requests\Transaction\StoreTransactionRequest;
use App\Http\Resources\Transaction\TransactionResource;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = User::find(auth()->user()->id);

        $page = $request->query("page", 1);
        $perPage = $request->query("perPage", 10);
        $sortBy = $request->query("sortBy", "created_at");
        $direction = $request->query("direction", "asc");

        $query = QueryBuilder::for(Transaction::class)
            ->whereNull("paid_at")
            ->with("transactionProducts");
        
        if ($user->role === Role::User->value) {
            $query = $query->where("user_id", $user->id);
        }

        $data = $query->orderBy($sortBy, $direction)
            ->paginate(
                perPage: $perPage,
                page: $page,
            )->withQueryString();

        $data = TransactionResource::collection($data);
        return $this->successResponse($data->resource);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = auth()->user();
        $data = $request->validated();

        $transaction = Transaction::createTransaction($user, $data);
        $transaction = $transaction->with("transactionProducts")->find($transaction->id);

        $transaction = new TransactionResource($transaction);
        return $this->successResponse($transaction);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction): \Illuminate\Http\JsonResponse
    {
        $transaction = $transaction->with("transactionProducts")->find($transaction->id);
        $transaction = new TransactionResource($transaction);
        return $this->successResponse($transaction);
    }

    /**
     * Update the specified resource in storage.
     */
    public function payment(PaymentTransactionRequest $request, Transaction $transaction): \Illuminate\Http\JsonResponse
    {
        $transaction->update(["paid_at" => now()]);
        $data = new TransactionResource($transaction->refresh());

        return $this->successResponse($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction): \Illuminate\Http\JsonResponse
    {
        if ($transaction->paid_at) {
            return $this->errorResponse("Transaction already paid, transaction cannot be deleted", 422);
        }

        $transaction->deleteOrFail();
        return $this->successResponse();
    }
}
