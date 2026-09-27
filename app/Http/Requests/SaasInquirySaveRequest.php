<?php

namespace App\Http\Requests;

use App\Rules\RecaptchaRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SaasInquirySaveRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'project_name' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:255'],
            'stage' => ['nullable', 'string', 'in:idea,spec,rewrite'],
            'budget' => ['nullable', 'string', 'in:sprint,custom,retainer'],
            'description' => ['required', 'string', 'max:5000'],
            'g-recaptcha-response' => ['required', new RecaptchaRule],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'project_name' => __('saas.contact.form.project_name'),
            'contact' => __('saas.contact.form.contact'),
            'stage' => __('saas.contact.form.stage'),
            'budget' => __('saas.contact.form.budget'),
            'description' => __('saas.contact.form.description'),
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'g-recaptcha-response.required' => __('saas.contact.form.recaptcha_required'),
        ];
    }
}
