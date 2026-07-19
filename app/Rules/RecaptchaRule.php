<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class RecaptchaRule implements Rule
{
    private array $errorCodes = [];

    /**
     * @throws ConnectionException
     */
    public function passes($attribute, $value)
    {
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $value,
            'remoteip' => request()->ip(),
        ]);

        $result = $response->json();

        $this->errorCodes = $result['error-codes'] ?? [];

        return $result['success'] ?? false;
    }

    public function message(): string
    {
        if (!empty($this->errorCodes)) {
            $errorMessages = [
                'missing-input-secret' => 'The secret parameter is missing.',
                'invalid-input-secret' => 'The secret parameter is invalid or malformed.',
                'missing-input-response' => 'The response parameter is missing.',
                'invalid-input-response' => 'The response parameter is invalid or malformed.',
                'bad-request' => 'The request is invalid or malformed.',
                'timeout-or-duplicate' => 'The response is no longer valid: either is too old or has been used previously.',
            ];

            $messages = array_map(function($code) use ($errorMessages) {
                return $errorMessages[$code] ?? $code;
            }, $this->errorCodes);

            return 'The reCAPTCHA verification failed: ' . implode(', ', $messages);
        }

        return 'The reCAPTCHA verification failed.';
    }
}
