<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovementRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'exists:products'],
            'storage_id' => ['required', 'exists:storages'],
            'quantity'   => ['required', 'numeric'],
            'before'     => ['required', 'numeric'],
            'after'      => ['required', 'numeric'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
