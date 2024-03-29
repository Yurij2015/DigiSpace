<?php

namespace App\Http\Requests\Section;

use Illuminate\Foundation\Http\FormRequest;

class SectionSaveRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255',
        ];
    }
}
