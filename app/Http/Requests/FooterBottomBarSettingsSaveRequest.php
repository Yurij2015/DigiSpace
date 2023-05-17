<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FooterBottomBarSettingsSaveRequest extends FormRequest
{
    public const CELL_RULE_VALUES = 'required|string|max:255';
    public function rules(): array
    {
        return [
            'company_name' => self::CELL_RULE_VALUES,
            'privacy_policy_title' => self::CELL_RULE_VALUES,
            'privacy_policy_href' => self::CELL_RULE_VALUES,
            'faq' => self::CELL_RULE_VALUES,
            'faq_href' => self::CELL_RULE_VALUES,
            'support' => self::CELL_RULE_VALUES,
            'support_href' => self::CELL_RULE_VALUES
        ];
    }
}
