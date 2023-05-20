<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubMenuSaveRequest extends FormRequest
{
    public const CELL_RULE_VALUES_STRING = 'string|max:255';
    public function rules(): array
    {
        return [
            'name' => self::CELL_RULE_VALUES_STRING,
            'slug' => self::CELL_RULE_VALUES_STRING,
            'href' => self::CELL_RULE_VALUES_STRING
        ];
    }
}
