<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkillTypeSaveRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'skill_type' => 'required|string|max:255',
        ];
    }
}
