<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubcategorySaveRequest extends FormRequest
{
    public const CELL_RULE_INT = 'nullable|integer';
    public const CELL_RULE_STRING = 'nullable|string|max:255';
    public function rules(): array
    {
        return [
            'section_id' => self::CELL_RULE_INT,
            'name' => 'required|string|max:255',
            'slug' => self::CELL_RULE_STRING,
            'type' => self::CELL_RULE_STRING,
            'progress' => 'nullable|string',
            'fa_icon' => self::CELL_RULE_STRING,
        ];
    }
}
