<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FooterUsefulLinkSaveRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'status' => 'required|bool',
            'position' => 'required|int',
        ];
    }
}
