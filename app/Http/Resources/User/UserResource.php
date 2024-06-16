<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/* @mixin \App\Models\User */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "email" => $this->email,
            "role" => $this->role,
            "profile" => $this->whenLoaded("profile", fn() => [
                "name" => $this->profile->name,
                "phone" => $this->profile->phone,
                "address" => $this->profile->address,
                "birth_date" => $this->profile->birth_date,
                "preferred_payment" => $this->profile->preferred_payment,
                "profile_photo" => asset($this->profile->profile_photo),
            ]),
        ];
    }
}
