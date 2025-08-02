<?php

namespace App\Http\Requests\Section;

use Illuminate\Foundation\Http\FormRequest;

class PlaceSaveRequest extends FormRequest
{
    public const CELL_RULE_VALUES = 'nullable|string|max:255';

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => self::CELL_RULE_VALUES,
            'logo_url' => self::CELL_RULE_VALUES,
            'fa_icon' => self::CELL_RULE_VALUES,
        ];
    }
}
