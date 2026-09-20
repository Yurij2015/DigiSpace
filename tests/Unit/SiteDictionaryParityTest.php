<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * Every public UI string lives in lang/{locale}/site.php; the three files must
 * expose the same keys with non-empty values so no locale falls back to English.
 */
class SiteDictionaryParityTest extends TestCase
{
    private const LOCALES = ['en', 'uk', 'pl'];

    public function test_site_dictionaries_share_the_same_keys(): void
    {
        $dictionaries = $this->dictionaries();
        $reference = array_keys($dictionaries['en']);

        foreach ($dictionaries as $locale => $dictionary) {
            self::assertSame([], array_values(array_diff($reference, array_keys($dictionary))), "keys missing in {$locale}");
            self::assertSame([], array_values(array_diff(array_keys($dictionary), $reference)), "extra keys in {$locale}");
        }
    }

    public function test_site_dictionaries_have_no_empty_values(): void
    {
        foreach ($this->dictionaries() as $locale => $dictionary) {
            foreach ($dictionary as $key => $value) {
                self::assertIsString($value, "{$locale}.{$key} is not a string");
                self::assertNotSame('', trim($value), "{$locale}.{$key} is empty");
            }
        }
    }

    /**
     * @return array<string, array<string, string>>
     */
    private function dictionaries(): array
    {
        $dictionaries = [];

        foreach (self::LOCALES as $locale) {
            $dictionaries[$locale] = require dirname(__DIR__, 2)."/lang/{$locale}/site.php"; // NOSONAR: same — need the array on every call
        }

        return $dictionaries;
    }
}
