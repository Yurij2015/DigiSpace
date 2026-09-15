<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasLocalizedContent
{
    protected function localizedValue(string $field, mixed $value): mixed
    {
        $translations = $this->getRawOriginal('translations');
        $translations = is_string($translations) ? json_decode($translations, true) : $translations;
        $locale = app()->getLocale();

        return data_get($translations, "$locale.$field")
            ?? data_get($translations, "en.$field")
            ?? $value;
    }

    protected function localizedAttribute(?string $field = null): Attribute
    {
        $field ??= '';

        return Attribute::make(
            get: fn (mixed $value): mixed => $this->localizedValue($field, $value),
        );
    }

    /**
     * translations is stored as {locale: {field: value}}. Empty values (null, "", the
     * "<p></p>" a rich editor emits for an untouched field) and empty locales are dropped
     * on write so that a blank tab falls back to English instead of rendering nothing.
     */
    protected function translations(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value): ?array => is_string($value) ? json_decode($value, true) : $value,
            set: fn (mixed $value): ?string => self::encodeTranslations($value),
        );
    }

    /**
     * @param  array<string, array<string, mixed>>|string|null  $value
     */
    public static function encodeTranslations(mixed $value): ?string
    {
        if (is_string($value)) {
            $value = json_decode($value, true);
        }

        if (! is_array($value)) {
            return null;
        }

        $clean = [];
        foreach ($value as $locale => $fields) {
            if (! is_array($fields)) {
                continue;
            }
            $kept = array_filter($fields, fn (mixed $field): bool => ! self::isBlankTranslation($field));
            if ($kept !== []) {
                $clean[$locale] = $kept;
            }
        }

        return $clean === [] ? null : json_encode($clean, JSON_UNESCAPED_UNICODE);
    }

    private static function isBlankTranslation(mixed $value): bool
    {
        if ($value === null) {
            return true;
        }
        if (! is_string($value)) {
            return false;
        }
        $stripped = trim(strip_tags($value));

        return $stripped === '' && ! str_contains($value, '<img');
    }
}
