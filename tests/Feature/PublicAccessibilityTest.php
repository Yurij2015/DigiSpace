<?php

namespace Tests\Feature;

use App\Models\ServiceCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Concerns\SeedsPublicSite;
use Tests\TestCase;

class PublicAccessibilityTest extends TestCase
{
    use RefreshDatabase;
    use SeedsPublicSite;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seedPublicSite();
    }

    public function test_brand_logo_has_the_site_name_as_alternative_text(): void
    {
        $this->get('/uk')
            ->assertOk()
            ->assertSee('alt="DigiSpace" width="170"', false)
            ->assertDontSee('<img class="brand__logo-dark" src="http://localhost:8100/images/DigiSpaceLogo2.svg" alt=""', false);
    }

    public function test_icon_only_social_links_have_accessible_names(): void
    {
        $response = $this->get('/uk')->assertOk();

        foreach (['Facebook', 'Twitter', 'Telegram', 'LinkedIn'] as $network) {
            $response->assertSee('aria-label="'.$network.'"', false);
        }

        $response->assertSee('target="_blank" rel="noopener"', false);
        $this->assertSame('', $this->socialLinksWithoutLabel($response->getContent()), 'every social icon link needs an aria-label');
    }

    public function test_toggles_and_search_controls_have_accessible_names(): void
    {
        $this->get('/uk')
            ->assertOk()
            ->assertSee('class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap" aria-label="Відкрити меню"', false)
            ->assertSee('data-rd-navbar-toggle=".rd-navbar-search" aria-label="Відкрити пошук"', false)
            ->assertSee('class="rd-navbar-search-submit" type="submit" aria-label="Шукати"', false)
            ->assertSee('aria-label="Показати контакти"', false);
    }

    public function test_language_selector_is_labelled_in_the_resolved_locale(): void
    {
        $this->get('/uk')->assertOk()
            ->assertSee('<summary class="site-language-control__toggle" aria-label="Мова: Українська">', false)
            ->assertSee('>Українська</a>', false)->assertSee('>Polski</a>', false)->assertSee('>English</a>', false);
        $this->get('/pl')->assertOk()->assertSee('aria-label="Język: Polski"', false);
        $this->get('/en')->assertOk()->assertSee('aria-label="Language: English"', false);
    }

    public function test_navigation_has_no_stray_text_when_service_categories_exist(): void
    {
        ServiceCategory::create(['name' => 'Web', 'slug' => 'web']);
        $this->rebootSharedContent();

        $html = $this->get('/uk')->assertOk()->getContent();

        preg_match('/<ul class="rd-navbar-nav">([\s\S]*?)<\/ul>\s*<\/div>\s*<\/div>/', $html, $nav);
        $this->assertNotEmpty($nav, 'navigation list not found');
        $this->assertStringContainsString('rd-navbar-dropdown', $nav[1]);
        $this->assertDoesNotMatchRegularExpression('/>\s*;\s*</', $nav[1], 'stray ";" text node in the navigation');
    }

    public function test_home_page_has_no_leftover_vue_mount_point(): void
    {
        $this->get('/')->assertOk()->assertDontSee('<div id="app">', false);
    }

    private function socialLinksWithoutLabel(string $html): string
    {
        preg_match_all('/<a class="icon[^"]*icon-style-brand[^"]*"[^>]*>/', $html, $matches);

        return implode("\n", array_filter($matches[0], fn (string $tag) => ! str_contains($tag, 'aria-label=')));
    }
}
