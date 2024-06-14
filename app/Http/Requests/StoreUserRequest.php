<?php

namespace App\Http\Requests;

use App\Enums\PaymentMethod;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

/* @mixin \App\Models\User */
class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => ["required", "string"],
            "email" => ["required", "email"],
            "password" => ["required", Password::min(8)],
            "address" => ["nullable", "string"],
            "birth_date" => ["nullable", "date_format:Y-m-d"],
            "preferred_payment" => Rule::enum(PaymentMethod::class),
            "profile_photo" => ["nullable", "image"],
        ];
    }
}
