<?php

namespace App\Support;

final class Locales
{
    public static function normalize(?string $locale): ?string
    {
        if ($locale === null || $locale === '') {
            return null;
        }

        $locale = strtolower(str_replace('_', '-', trim($locale)));
        $locale = config('locales.aliases.'.$locale, $locale);

        if (! in_array($locale, config('locales.supported', []), true) && str_contains($locale, '-')) {
            $locale = explode('-', $locale, 2)[0];
            $locale = config('locales.aliases.'.$locale, $locale);
        }

        return in_array($locale, config('locales.supported', []), true) ? $locale : null;
    }

    public static function default(): string
    {
        return (string) config('locales.default', config('app.locale', 'en'));
    }

    public static function fallback(): string
    {
        return (string) config('locales.fallback', config('app.fallback_locale', 'en'));
    }
}
