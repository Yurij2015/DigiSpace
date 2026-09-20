<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\Post;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;
use DOMDocument;
use DOMElement;
use DOMXPath;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class GenerateSitemapTest extends TestCase
{
    use RefreshDatabase;

    #[TestWith(['en'])]
    #[TestWith(['pl'])]
    public function test_every_resource_has_all_locale_entries_and_reciprocal_alternates(string $defaultLocale): void
    {
        config(['locales.default' => $defaultLocale]);
        $author = User::factory()->create();
        $category = Category::create(['name' => 'News', 'slug' => 'news', 'description' => 'News', 'user_id' => $author->id]);
        Post::create([
            'name' => 'Published', 'slug' => 'published', 'content' => '<p>Post</p>', 'status' => 'published',
            'category_id' => $category->id, 'user_id' => $author->id, 'created_at' => '2026-09-01 12:00:00',
        ]);
        Post::create([
            'name' => 'Draft', 'slug' => 'draft', 'content' => '<p>Draft</p>', 'status' => 'draft',
            'category_id' => $category->id, 'user_id' => $author->id,
        ]);
        $item = MenuItem::create(['name' => 'CMS', 'slug' => 'cms']);
        Page::create(['name' => 'CMS', 'menu_item_id' => $item->id]);
        $serviceCategory = ServiceCategory::create(['name' => 'Web']);
        Service::create(['title' => 'Active', 'slug' => 'active', 'status' => 'active', 'service_category_id' => $serviceCategory->id]);
        Service::create(['title' => 'Inactive', 'slug' => 'inactive', 'status' => 'inactive', 'service_category_id' => $serviceCategory->id]);
        $output = Storage::fake('sitemap-test');
        $originalPublicPath = public_path();
        $this->app->usePublicPath($output->path(''));

        try {
            $this->artisan('sitemap:generate')->assertExitCode(0);
        } finally {
            $this->app->usePublicPath($originalPublicPath);
        }

        $output->assertExists('sitemap.xml');
        $document = new DOMDocument;
        $this->assertTrue($document->loadXML($output->get('sitemap.xml')));
        $xpath = new DOMXPath($document);
        $xpath->registerNamespace('s', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $xpath->registerNamespace('x', 'http://www.w3.org/1999/xhtml');
        $paths = [
            '', '/about', '/services', '/pricing', '/promos', '/blog', '/contact-us', '/privacy-policy', '/faq', '/support',
            '/pages/cms', '/blog/published', '/blog-category/news', '/blog-archive/2026-9', '/service-category/web', '/service-category/web/active',
        ];
        $this->assertCount(count($paths) * 3, $xpath->query('/s:urlset/s:url'));

        foreach ($paths as $path) {
            $expectedAlternates = [
                'en' => 'http://localhost:8100/en'.$path,
                'uk' => 'http://localhost:8100/uk'.$path,
                'pl' => 'http://localhost:8100/pl'.$path,
                'x-default' => 'http://localhost:8100/'.$defaultLocale.$path,
            ];
            foreach (['en', 'uk', 'pl'] as $locale) {
                $url = 'http://localhost:8100/'.$locale.$path;
                $entries = $xpath->query('/s:urlset/s:url[s:loc="'.$url.'"]');
                $this->assertCount(1, $entries, $url);
                $links = $xpath->query('x:link', $entries->item(0));
                $this->assertCount(4, $links, $url);
                $actualAlternates = [];
                /** @var DOMElement $link */
                foreach ($links as $link) {
                    $this->assertSame('alternate', $link->getAttribute('rel'));
                    $actualAlternates[$link->getAttribute('hreflang')] = $link->getAttribute('href');
                }
                $this->assertSame($expectedAlternates, $actualAlternates, $url);
            }
        }

        $this->assertStringNotContainsString('/blog/draft', $output->get('sitemap.xml'));
        $this->assertStringNotContainsString('/web/inactive', $output->get('sitemap.xml'));
    }
}
