<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HeaderNavBarSettingsSaveRequest extends FormRequest
{
    public const CELL_RULE_VALUES = 'required|string|max:255';
    public function rules(): array
    {
        return [
            'first_col_name' => self::CELL_RULE_VALUES,
            'first_col_href' => self::CELL_RULE_VALUES,
            'first_col_href_content' => self::CELL_RULE_VALUES,
            'second_col_name' => self::CELL_RULE_VALUES,
            'second_col_href' => self::CELL_RULE_VALUES,
            'second_col_href_content' => self::CELL_RULE_VALUES,
            'first_soc_button_style' => self::CELL_RULE_VALUES,
            'first_soc_button_href' => self::CELL_RULE_VALUES,
            'second_soc_button_style' => self::CELL_RULE_VALUES,
            'second_soc_button_href' => self::CELL_RULE_VALUES,
            'third_soc_button_style' => self::CELL_RULE_VALUES,
            'third_soc_button_href' => self::CELL_RULE_VALUES,
            'fourth_soc_button_style' => self::CELL_RULE_VALUES,
            'fourth_soc_button_href' => self::CELL_RULE_VALUES,
            'login_button_status' => 'required|bool'
        ];
    }
}
