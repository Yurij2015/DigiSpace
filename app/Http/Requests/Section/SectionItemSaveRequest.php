<?php

namespace App\Http\Requests\Section;

use Illuminate\Foundation\Http\FormRequest;

class SectionItemSaveRequest extends FormRequest
{
    public const CELL_RULE_INT = 'nullable|integer';

    public const CELL_RULE_STRING = 'nullable|string|max:255';

    public function rules(): array
    {
        return [
            'section_id' => self::CELL_RULE_INT,
            'subcategory_id' => self::CELL_RULE_INT,
            'name' => 'required|string|max:255',
            'slug' => self::CELL_RULE_STRING,
            'title' => self::CELL_RULE_STRING,
            'place_id' => self::CELL_RULE_INT,
            'period' => 'nullable|array',
            'image_icon_url' => self::CELL_RULE_STRING,
            'fa_icon' => self::CELL_RULE_STRING,
            'value' => self::CELL_RULE_STRING,
            'logo_url' => self::CELL_RULE_STRING,
            'href' => self::CELL_RULE_STRING,
        ];
    }
}
