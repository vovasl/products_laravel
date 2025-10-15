<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:100',
            ],
            'sku' => [
                'required',
                'string',
                'max:50',
            ],
            'price' => [
                'required',
                'numeric',
                'min:0',
            ],
            'quantity' => [
                'required',
                'integer',
                'min:0',
            ],
            'image' => [
                'nullable',
                'image',
                'max:2048',
            ],
        ];
    }
}
