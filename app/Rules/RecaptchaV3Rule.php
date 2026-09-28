<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Translation\PotentiallyTranslatedString;

/**
 * Verifies an invisible reCAPTCHA v3 token: the request must succeed, carry the expected action
 * (a token minted for another form must not be replayed here) and score at least the configured
 * threshold (1.0 = very likely human, 0.0 = very likely a bot).
 */
readonly class RecaptchaV3Rule implements ValidationRule
{
    public function __construct(private string $action) {}

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) || $value === '') {
            $fail(__('saas.contact.form.recaptcha_failed'));

            return;
        }

        try {
            $result = Http::asForm()->timeout(5)->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => config('services.recaptcha_v3.secret_key'),
                'response' => $value,
                'remoteip' => request()->ip(),
            ])->json();
        } catch (ConnectionException $exception) {
            Log::warning('reCAPTCHA v3 verification request failed', ['error' => $exception->getMessage()]);
            $fail(__('saas.contact.form.recaptcha_failed'));

            return;
        }

        $passed = ($result['success'] ?? false) === true
            && ($result['action'] ?? null) === $this->action
            && (float) ($result['score'] ?? 0) >= (float) config('services.recaptcha_v3.min_score', 0.5);

        if (! $passed) {
            Log::info('reCAPTCHA v3 rejected a submission', [
                'action' => $result['action'] ?? null,
                'score' => $result['score'] ?? null,
                'error-codes' => $result['error-codes'] ?? [],
            ]);
            $fail(__('saas.contact.form.recaptcha_failed'));
        }
    }
}
