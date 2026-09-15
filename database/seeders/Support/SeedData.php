<?php

namespace Database\Seeders\Support;

use App\Support\Translations;
use RuntimeException;

/**
 * Loads database/seeders/data/{table}.json:
 * {
 *   "table": "widgets", "identity": [...], "translatable": ["title", ...],
 *   "rows": [{ ...base columns..., "i18n": {"en": {...}, "uk": {...}, "pl": {...}} }]
 * }
 * and maps each row to the insert shape: base columns from "en", the other locales under
 * "translations" (JSON, empty values pruned the same way the models do on save).
 */
final class SeedData
{
    /** @var list<string> */
    public const LOCALES = ['en', 'uk', 'pl'];

    public const BASE_LOCALE = 'en';

    /**
     * @return array{table: string, identity: list<string>, translatable: list<string>, rows: list<array<string, mixed>>}
     */
    public static function load(string $table): array
    {
        $path = self::path($table);

        if (! is_file($path)) {
            throw new RuntimeException("Seed data file missing: {$path}");
        }

        $data = json_decode((string) file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);

        foreach (['table', 'identity', 'translatable', 'rows'] as $key) {
            if (! array_key_exists($key, $data)) {
                throw new RuntimeException("Seed data {$table}.json lacks \"{$key}\"");
            }
        }

        self::validate($data);

        return $data;
    }

    public static function path(string $table): string
    {
        return __DIR__.'/../data/'.$table.'.json';
    }

    /**
     * Insert-ready rows: base columns + translations JSON. Timestamps are added by the caller.
     *
     * @return list<array<string, mixed>>
     */
    public static function rows(string $table): array
    {
        $data = self::load($table);
        $rows = [];

        foreach ($data['rows'] as $row) {
            $rows[] = self::toColumns($row);
        }

        return $rows;
    }

    /**
     * @param  array<string, mixed>  $row
     * @return array<string, mixed>
     */
    public static function toColumns(array $row): array
    {
        $i18n = $row['i18n'] ?? [];
        unset($row['i18n']);

        foreach ($i18n[self::BASE_LOCALE] ?? [] as $field => $value) {
            $row[$field] = $value;
        }

        $row['translations'] = self::translations($i18n);

        return $row;
    }

    /**
     * translations JSON (or null) for the non-base locales of one row.
     *
     * @param  array<string, array<string, mixed>>  $i18n
     */
    public static function translations(array $i18n): ?string
    {
        unset($i18n[self::BASE_LOCALE]);

        return Translations::encode($i18n);
    }

    /**
     * Every translatable field of every row must carry a non-empty value for all locales.
     *
     * @param  array{table: string, identity: list<string>, translatable: list<string>, rows: list<array<string, mixed>>}  $data
     */
    private static function validate(array $data): void
    {
        foreach ($data['rows'] as $index => $row) {
            $i18n = $row['i18n'] ?? null;
            if (! is_array($i18n)) {
                throw new RuntimeException("{$data['table']}.json row #{$index} has no i18n block");
            }
            foreach (self::LOCALES as $locale) {
                foreach ($data['translatable'] as $field) {
                    $value = $i18n[$locale][$field] ?? null;
                    $base = $i18n[self::BASE_LOCALE][$field] ?? null;
                    // A field that is empty in the base language is allowed to be empty everywhere.
                    if (self::isBlank($base)) {
                        continue;
                    }
                    if (self::isBlank($value)) {
                        throw new RuntimeException("{$data['table']}.json row #{$index}: missing {$locale}.{$field}");
                    }
                }
            }
        }
    }

    private static function isBlank(mixed $value): bool
    {
        return Translations::isBlank($value);
    }
}
