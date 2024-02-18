<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkSaveRequest extends FormRequest
{
    public const CELL_RULE_VALUES = 'nullable|string|max:255';
    public function rules(): array
    {
        return [
            'item_id' => 'nullable|integer',
            'fa_icon' => self::CELL_RULE_VALUES,
            'href' => self::CELL_RULE_VALUES,
        ];
    }
}
