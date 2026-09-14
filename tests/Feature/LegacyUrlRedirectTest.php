<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Concerns\SeedsPublicSite;
use Tests\TestCase;

class LegacyUrlRedirectTest extends TestCase
{
    use RefreshDatabase;
    use SeedsPublicSite;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seedPublicSite();
    }

    public function test_unprefixed_top_level_page_redirects_to_the_default_locale(): void
    {
        $this->get('/about')->assertRedirect('/en/about');
    }

    public function test_unprefixed_page_resolves_after_the_redirect(): void
    {
        $this->followingRedirects()
            ->get('/about')
            ->assertOk()
            ->assertSee('<html class="wide wow-animation" lang="en">', false);
    }

    public function test_unprefixed_urls_redirect_to_the_session_locale(): void
    {
        $this->withSession(['locale' => 'pl'])
            ->get('/about')
            ->assertRedirect('/pl/about');
    }

    public function test_unprefixed_urls_honour_the_browser_language(): void
    {
        $this->withHeaders(['Accept-Language' => 'uk-UA,uk;q=0.9'])
            ->get('/faq')
            ->assertRedirect('/uk/faq');
    }

    public function test_head_requests_redirect_like_get(): void
    {
        $this->head('/about')->assertRedirect('/en/about');
    }

    public function test_unprefixed_blog_post_url_redirects(): void
    {
        $this->get('/blog/some-post')->assertRedirect('/en/blog/some-post');
    }

    public function test_query_string_is_preserved(): void
    {
        $this->get('/contact-us?x=1&y=two')->assertRedirect('/en/contact-us?x=1&y=two');
    }

    public function test_prefixed_urls_are_served_directly(): void
    {
        $this->get('/uk/about')->assertOk();
    }

    public function test_unknown_urls_are_not_redirected(): void
    {
        $this->get('/this-does-not-exist')->assertNotFound();
        $this->get('/admn')->assertNotFound();
    }

    public function test_post_to_an_unprefixed_url_is_not_redirected(): void
    {
        $this->post('/contact-us', [])->assertNotFound();
    }
}
