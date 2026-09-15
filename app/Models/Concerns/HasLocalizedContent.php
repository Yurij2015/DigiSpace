<?php

namespace App\Models\Concerns;

use App\Support\Translations;
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
            set: fn (mixed $value): ?string => Translations::encode($value),
        );
    }
}
