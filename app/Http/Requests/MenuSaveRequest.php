<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuSaveRequest extends FormRequest
{
    public const CELL_RULE_VALUES_STRING = 'string|max:255';
    public const CELL_RULE_VALUES_INT = 'int';

    public function rules(): array
    {
        return [
            'name' => self::CELL_RULE_VALUES_STRING,
            'title' => self::CELL_RULE_VALUES_STRING,
            'level' => self::CELL_RULE_VALUES_INT,
            'position' => self::CELL_RULE_VALUES_INT,
            'description' => self::CELL_RULE_VALUES_STRING,
            'location' => self::CELL_RULE_VALUES_STRING,
            'slug' => self::CELL_RULE_VALUES_STRING,
            'href' => self::CELL_RULE_VALUES_STRING
        ];
    }
}
