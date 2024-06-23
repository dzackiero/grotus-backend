<?php

namespace App\Http\Requests\User;

use App\Enums\PaymentMethod;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
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
            "name" => ["nullable", "string"],
            "email" => ["nullable", "email", "unique:users,email," . $this->route("user")->id],
            "password" => ["nullable", Password::min(8)],
            "phone" => ["nullable", "string"],
            "address" => ["nullable", "string"],
            "birth_date" => ["nullable", "date_format:Y-m-d"],
            "preferred_payment" => ["nullable", Rule::enum(PaymentMethod::class)],
            "profile_photo" => ["nullable", "image"],
        ];
    }
}
