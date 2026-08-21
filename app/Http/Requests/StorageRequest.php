<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'          => ['required'],
            'slug'          => ['required'],
            'products'      => ['nullable', 'array'],
            'products.*.id' => ['nullable', 'exists:products,id']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
