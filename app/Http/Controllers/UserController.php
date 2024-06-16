<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $page = $request->query("page", 1);
        $perPage = $request->query("perPage", 10);

        $data = QueryBuilder::for(User::class)->with(["profile"])
            ->paginate(
                perPage: $perPage,
                page: $page,
            );

        $data = UserResource::collection($data);
        return $this->successResponse($data->resource);
    }

    public function store(StoreUserRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $user = User::createUser(
            $data["name"],
            $data["email"],
            $data["password"],
            $data["address"],
            $data["birth_date"],
        );

        if ($request->hasFile("profile_photo")) {
            $profile = $request->file("profile_photo");
            $user->uploadProfile($profile);
        }

        $data = new UserResource($user->with(["profile"])->find($user->id));
        return $this->successResponse($data);
    }

    public function show(User $user): \Illuminate\Http\JsonResponse
    {
        $data = new UserResource($user->with(["profile"])->find($user->id));
        return $this->successResponse($data);
    }


    public function update(UpdateUserRequest $request, User $user): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $user->updateUser(
            $data["name"],
            $data["email"],
            $data["password"],
            $data["address"],
            $data["birth_date"],
        );

        if ($request->hasFile("profile_photo")) {
            $profile = $request->file("profile_photo");
            $user->uploadProfile($profile);
        }
        $data = new UserResource($user->with(["profile"])->find($user->id));

        return $this->successResponse($data);
    }

    public function destroy(User $user): \Illuminate\Http\JsonResponse
    {
        $user->deleteOrFail();
        return $this->successResponse();
    }
}
