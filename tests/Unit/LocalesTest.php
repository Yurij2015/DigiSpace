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
}
