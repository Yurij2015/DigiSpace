<?php

namespace App\Support;

/**
 * Canonical form of the translations JSON column ({locale: {field: value}}): empty values
 * (null, "", the "<p></p>" a rich editor emits for an untouched field) and empty locales are
 * dropped, so a blank translation falls back to the base language instead of rendering nothing.
 */
final class Translations
{
    /**
     * @param  array<string, array<string, mixed>>|string|null  $value
     */
    public static function encode(mixed $value): ?string
    {
        $clean = self::prune($value);

        return $clean === [] ? null : json_encode($clean, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param  array<string, array<string, mixed>>|string|null  $value
     * @return array<string, array<string, mixed>>
     */
    public static function prune(mixed $value): array
    {
        if (is_string($value)) {
            $value = json_decode($value, true);
        }

        if (! is_array($value)) {
            return [];
        }

        $clean = [];
        foreach ($value as $locale => $fields) {
            if (! is_array($fields)) {
                continue;
            }
            $kept = array_filter($fields, fn (mixed $field): bool => ! self::isBlank($field));
            if ($kept !== []) {
                $clean[$locale] = $kept;
            }
        }

        return $clean;
    }

    public static function isBlank(mixed $value): bool
    {
        if ($value === null) {
            return true;
        }
        if (! is_string($value)) {
            return false;
        }

        return trim(strip_tags($value)) === '' && ! str_contains($value, '<img');
    }
}
