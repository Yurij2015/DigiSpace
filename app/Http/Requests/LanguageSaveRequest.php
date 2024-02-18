<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageSaveRequest extends FormRequest
{
    public const CELL_RULE_VALUES = 'nullable|string|max:255';
    public function rules(): array
    {
        return [
            'lang_code' => 'required|string|max:255',
            'title' => self::CELL_RULE_VALUES,
            'description' => self::CELL_RULE_VALUES,
            'subtitle' => self::CELL_RULE_VALUES,
            'subtitle_description' => self::CELL_RULE_VALUES,
            'tags' => 'required|array',
        ];
    }
}
