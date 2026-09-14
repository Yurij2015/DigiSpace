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
}
