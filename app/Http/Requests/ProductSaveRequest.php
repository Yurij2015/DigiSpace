<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductSaveRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'details' => 'required|string|max:255',
            'price_value' => 'required',
            'product_code' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'is_active' => 'boolean',
            'position' => 'nullable|integer',
            'is_prefered' => 'boolean',
            'services' => 'nullable|array',
            'services.*' => 'exists:services,id',
        ];
    }
}
