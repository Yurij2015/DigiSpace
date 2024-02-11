<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkillSubcategorySaveRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'skill_type_id' => 'required|integer|max:4',
            'skill_progress' => 'nullable|string|max:255',
            'type' => 'required|string|max:255',
            'fa_icon' => 'required|string|max:255',
            'locales' => 'required|array',
        ];
    }
}
