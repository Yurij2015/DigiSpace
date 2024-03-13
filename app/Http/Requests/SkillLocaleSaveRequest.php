<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkillLocaleSaveRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'lang' => 'required|string',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ];
    }
}
