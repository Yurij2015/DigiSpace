<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkillSaveRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'skill_type_id' => 'required|integer|max:4',
            'image_icon_url' => 'nullable|string|max:255',
            'fa_icon' => 'required|string|max:255',
            'value' => 'nullable|string|max:255',
            'locales' => 'required|array',
        ];
    }
}
