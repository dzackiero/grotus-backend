<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            "price" => ["nullable", "numeric", "min:0"],
            "stock" => ["nullable", "numeric", "min:0"],
            "description" => ["nullable", "string"],
            "images.*" => ['nullable', 'image', 'max:2048'],
        ];
    }
}
