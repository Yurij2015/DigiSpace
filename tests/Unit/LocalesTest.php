<?php

namespace Tests\Unit;

use App\Support\Locales;
use Tests\TestCase;

class LocalesTest extends TestCase
{
    public function test_supported_locales_are_normalized(): void
    {
        self::assertSame('uk', Locales::normalize('ua'));
        self::assertSame('uk', Locales::normalize('UK'));
        self::assertSame('pl', Locales::normalize('pl_PL'));
        self::assertNull(Locales::normalize('de'));
    }

    public function test_site_relative_paths_are_prefixed_with_the_current_locale(): void
    {
        app()->setLocale('uk');

        self::assertSame('/uk/faq', Locales::localizeUrl('/faq'));
        self::assertSame('/uk/faq', Locales::localizeUrl('faq'));
        self::assertSame('/pl/privacy-policy', Locales::localizeUrl('/privacy-policy', 'pl'));
        self::assertSame('/uk/blog-search?search=laravel', Locales::localizeUrl('/blog-search?search=laravel'));
    }

    public function test_external_and_special_links_are_left_untouched(): void
    {
        self::assertSame('https://example.com/faq', Locales::localizeUrl('https://example.com/faq'));
        self::assertSame('//cdn.example.com/x', Locales::localizeUrl('//cdn.example.com/x'));
        self::assertSame('mailto:hello@example.com', Locales::localizeUrl('mailto:hello@example.com'));
        self::assertSame('#top', Locales::localizeUrl('#top'));
        self::assertSame('', Locales::localizeUrl(''));
    }

    public function test_already_prefixed_and_non_public_paths_are_left_untouched(): void
    {
        app()->setLocale('uk');

        self::assertSame('/pl/faq', Locales::localizeUrl('/pl/faq'));
        self::assertSame('/login', Locales::localizeUrl('/login'));
        self::assertSame('/admin', Locales::localizeUrl('/admin'));
        self::assertSame('/no-such-page', Locales::localizeUrl('/no-such-page'));
    }
}
