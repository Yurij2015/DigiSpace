<?php

namespace App\Http\Requests;

use App\Rules\RecaptchaV3Rule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SaasInquirySaveRequest extends FormRequest
{
    /** reCAPTCHA v3 action the landing form requests its token for (checked server-side). */
    public const RECAPTCHA_ACTION = 'saas_inquiry';

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
            'g-recaptcha-response' => ['required', new RecaptchaV3Rule(self::RECAPTCHA_ACTION)],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'project_name' => __($this->copy().'.contact.form.project_name'),
            'contact' => __($this->copy().'.contact.form.contact'),
            'stage' => __($this->copy().'.contact.form.stage'),
            'budget' => __($this->copy().'.contact.form.budget'),
            'description' => __($this->copy().'.contact.form.description'),
        ];
    }

    /**
     * The landing's lang file, so labels and messages match the form the visitor filled in.
     */
    private function copy(): string
    {
        return $this->routeIs('development.business.*') ? 'business' : 'saas';
    }

    /**
     * Send the visitor back to the form (at the bottom of a long page), not to the top.
     */
    protected function getRedirectUrl(): string
    {
        return strtok(parent::getRedirectUrl(), '#').'#contact';
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        // The landing forms carry their own short messages in the landing's lang file.
        return [
            'required' => __($this->copy().'.contact.form.validation.required'),
            'max' => __($this->copy().'.contact.form.validation.max'),
            'string' => __($this->copy().'.contact.form.validation.invalid'),
            'in' => __($this->copy().'.contact.form.validation.invalid'),
            'g-recaptcha-response.required' => __($this->copy().'.contact.form.recaptcha_failed'),
        ];
    }
}
