<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceSaveRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'details' => 'required|string|max:255',
            'price' => 'required',
            'service_category_id' => 'nullable|integer',
            'seo_keywords' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_title' => 'nullable|string|max:255',
            'image_alt' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'slug' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255',
            'file' => '',
        ];
    }
}
