<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageSaveRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'meta' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'content' => 'required|string'
        ];
    }
}
