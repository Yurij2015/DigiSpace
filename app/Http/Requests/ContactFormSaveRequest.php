<?php

namespace App\Http\Requests;

use App\Rules\RecaptchaRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactFormSaveRequest extends FormRequest
{
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'message' => 'required',
            'g-recaptcha-response' => ['required', new RecaptchaRule()],
        ];
    }

    //messge for recaptcha

    public function messages(): array
    {
        return [
            'g-recaptcha-response.required' => 'Please complete the reCAPTCHA to verify you are not a robot.',
        ];
    }

}
