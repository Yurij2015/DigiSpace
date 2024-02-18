<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocaleSaveRequest extends FormRequest
{
    public const CELL_RULE_VALUES = 'nullable|integer';

    public function rules(): array
    {
        return [
            'section_id' => self::CELL_RULE_VALUES,
            'item_id' => self::CELL_RULE_VALUES,
            'place_id' => self::CELL_RULE_VALUES,
            'subcategory_id' => self::CELL_RULE_VALUES,
            'en_id' => self::CELL_RULE_VALUES,
            'ua_id' => self::CELL_RULE_VALUES,
            'pl_id' => self::CELL_RULE_VALUES,
        ];
    }
}
