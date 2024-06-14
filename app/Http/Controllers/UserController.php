<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query("page", 1);
        $perPage = $request->query("perPage", 10);

        $data = QueryBuilder::for(User::class)->with(["profile"])
            ->paginate(
                perPage: $perPage,
                page: $page,
            );

        return $data;
    }

    public function store(StoreUserRequest $request)
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

        return $user->refresh();
    }
}
