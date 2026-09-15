<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Concerns\SeedsPublicSite;
use Tests\TestCase;

class LocalizedChromeTest extends TestCase
{
    use RefreshDatabase;
    use SeedsPublicSite;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seedPublicSite();
    }

    public function test_ukrainian_about_page_has_localized_breadcrumb_and_title(): void
    {
        $this->get('/uk/about')
            ->assertOk()
            ->assertSee('<title>DigiSpace | Про нас</title>', false)
            ->assertSee('<h2 class="breadcrumbs-custom__title">Про нас</h2>', false)
            ->assertSee('>Головна</a>', false)
            ->assertDontSee('>Home<', false);
    }

    public function test_ukrainian_home_hero_is_localized_and_links_to_the_localized_page(): void
    {
        $this->get('/uk')
            ->assertOk()
            ->assertSee('<h1 data-caption-animate="fadeInUpSmall">Відкриваємо простір високих технологій - DigiSpace</h1>', false)
            ->assertSee('href="http://localhost:8100/uk/pages/opening-the-space-of-high-technologies"', false)
            ->assertSee('>Детальніше</a>', false)
            ->assertSee('<h2>Тарифні плани</h2>', false)
            ->assertSee('<h2>Наші послуги</h2>', false)
            ->assertDontSee('Opening the Space of High Technologies')
            ->assertDontSee('>Read More<', false);
    }

    public function test_polish_contact_page_chrome_is_polish(): void
    {
        $this->get('/pl/contact-us')
            ->assertOk()
            ->assertSee('<title>DigiSpace | Kontakt</title>', false)
            ->assertSee('Formularz kontaktowy')
            ->assertSee('>Strona główna</a>', false)
            ->assertSee('>Wyślij wiadomość</button>', false)
            ->assertDontSee('>Send Message<', false);
    }

    public function test_english_stays_the_default(): void
    {
        $this->get('/en/about')
            ->assertOk()
            ->assertSee('<title>DigiSpace | About</title>', false)
            ->assertSee('>Home</a>', false);
    }
}
