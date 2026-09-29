<?php

namespace App\Http\Requests;

use App\Rules\RecaptchaV3Rule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactFormSaveRequest extends FormRequest
{
    public const RECAPTCHA_ACTION = 'contact_us';

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'phone:INTERNATIONAL', 'max:50'],
            'message' => ['required', 'string', 'max:5000'],
            'g-recaptcha-response' => ['required', 'string', new RecaptchaV3Rule(self::RECAPTCHA_ACTION, 'site.recaptcha_failed')],
        ];
    }

    public function messages(): array
    {
        return [
            'g-recaptcha-response.required' => __('site.recaptcha_failed'),
        ];
    }
}
