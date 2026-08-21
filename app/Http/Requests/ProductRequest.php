<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'           => ['required'],
            'quantity'       => ['required', 'numeric'],
            'expired_at'     => ['required'],
            'movements'      => ['nullable', 'array'],
            'movements.*.id' => ['nullable', 'exists:movements,id'],
            'storages'       => ['nullable', 'array'],
            'storages.*.id'  => ['nullable', 'exists:storages,id'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
