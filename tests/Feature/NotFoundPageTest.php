<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Concerns\SeedsPublicSite;
use Tests\TestCase;

class NotFoundPageTest extends TestCase
{
    use RefreshDatabase;
    use SeedsPublicSite;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seedPublicSite();
    }

    public function test_unmatched_route_renders_the_branded_404(): void
    {
        $this->get('/this-does-not-exist')
            ->assertNotFound()
            ->assertSee('<title>DigiSpace | Page not found</title>', false)
            ->assertSee('Sorry, but the page was not found')
            ->assertSee('class="rd-navbar-brand"', false)
            ->assertSee('class="section footer-classic', false)
            ->assertSee('class="site-language-control site-language-control--desktop"', false)
            ->assertDontSee('DigiSpace | About');
    }

    public function test_unmatched_route_under_a_locale_prefix_uses_that_locale(): void
    {
        $this->get('/uk/this-does-not-exist')
            ->assertNotFound()
            ->assertSee('<html class="wide wow-animation" lang="uk">', false)
            ->assertSee('На жаль, сторінку не знайдено');
    }

    public function test_missing_page_slug_renders_the_branded_404(): void
    {
        $this->get('/uk/pages/does-not-exist')
            ->assertNotFound()
            ->assertSee('<title>DigiSpace | Сторінку не знайдено</title>', false)
            ->assertSee('class="rd-navbar-brand"', false);
    }

    public function test_missing_blog_slug_renders_the_branded_404(): void
    {
        $this->get('/uk/blog/does-not-exist')
            ->assertNotFound()
            ->assertSee('На жаль, сторінку не знайдено')
            ->assertSee('class="section footer-classic', false);
    }

    public function test_session_locale_localizes_the_404_copy(): void
    {
        $this->withSession(['locale' => 'pl'])
            ->get('/does-not-exist')
            ->assertNotFound()
            ->assertSee('Przepraszamy, strona nie została znaleziona')
            ->assertSee('Przejdź na stronę główną')
            ->assertSee('Przejdź do bloga');
    }
}
