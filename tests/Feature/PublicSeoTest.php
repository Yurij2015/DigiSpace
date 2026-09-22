<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\Post;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;
use App\Models\Widget;
use DOMDocument;
use DOMXPath;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\Feature\Concerns\SeedsPublicSite;
use Tests\TestCase;

class PublicSeoTest extends TestCase
{
    use RefreshDatabase;

    private const BLOG_TITLE = 'DigiSpace | Blog';

    private const CATEGORY_DESCRIPTION = 'Category description';

    private const CATEGORY_SEO = 'Category SEO';

    private const WIDGET_IMAGE_URL = 'http://localhost:8100/uploads/widgets/photo.jpg';

    private const PAGE_NAME = 'CMS page';

    use SeedsPublicSite;

    #[TestWith(['/en/blog'])]
    #[TestWith(['/en/blog-category/news'])]
    #[TestWith(['/en/blog-archive/2026-9'])]
    #[TestWith(['/en/blog-search?search=Article'])]
    public function test_listing_metadata_does_not_inherit_a_post(string $path): void
    {
        $this->seedPublicSite();
        $this->createPost();

        $response = $this->get($path);

        $response->assertOk();
        $document = $this->document($response->getContent());
        $expectedTitle = match (true) {
            str_contains($path, 'blog-category') => 'DigiSpace | News articles',
            str_contains($path, 'blog-archive') => 'DigiSpace | Blog archive 2026-9',
            default => self::BLOG_TITLE,
        };
        $expectedDescription = match (true) {
            str_contains($path, 'blog-category') => 'News',
            str_contains($path, 'blog-archive') => __('site.meta_description_blog_archive', ['date' => '2026-9']),
            default => __('site.meta_description_blog'),
        };
        $this->assertSame($expectedTitle, $this->meta($document, 'og:title'));
        $this->assertSame($expectedTitle, $this->meta($document, 'twitter:title'));
        $this->assertSame('website', $this->meta($document, 'og:type'));
        $this->assertSame(asset('images/bg-3-1920x480.jpg'), $this->meta($document, 'og:image'));
        $this->assertSame($expectedDescription, $this->meta($document, 'og:description'));
        $this->assertSame($expectedTitle, $this->schemaNode($document, 'WebPage')['name']);
        $this->assertSame('', $this->meta($document, 'keywords'));
    }

    public function test_post_metadata_and_schema_preserve_the_article_and_escape_markup(): void
    {
        $this->seedPublicSite();
        $post = $this->createPost();
        $post->update(['name' => 'Article </script><script>alert("seo")</script>']);

        $response = $this->get('/uk/blog/article');

        $response->assertOk();
        $document = $this->document($response->getContent());
        $this->assertSame($post->name, $this->meta($document, 'og:title'));
        $this->assertSame('article', $this->meta($document, 'og:type'));
        $this->assertSame(asset('uploads/article.jpg'), $this->meta($document, 'og:image'));
        $article = $this->schemaNode($document, 'BlogPosting');
        $this->assertSame($post->name, $article['headline']);
        $this->assertSame('uk', $article['inLanguage']);
        $this->assertSame($this->meta($document, 'og:image'), $article['image']);
        $this->assertSame(0, $document->query('//script[text()=\'alert("seo")\']')->length);
    }

    #[TestWith(['uk', 'Розробка сайту', 'Створюємо сайти'])]
    #[TestWith(['pl', 'Budowa strony', 'Tworzymy strony'])]
    public function test_service_uses_its_localized_metadata(string $locale, string $title, string $description): void
    {
        $this->seedPublicSite();
        $category = ServiceCategory::create(['name' => 'Web', 'seo_title' => self::CATEGORY_SEO, 'seo_description' => self::CATEGORY_DESCRIPTION]);
        Service::create([
            'title' => 'Development', 'slug' => 'development', 'service_category_id' => $category->id,
            'status' => 'active',
            'seo_title' => 'Service SEO', 'seo_description' => 'Service description', 'image' => 'development.jpg',
            'translations' => [$locale => ['seo_title' => $title, 'seo_description' => $description]],
        ]);

        $response = $this->get("/$locale/service-category/web/development");

        $response->assertOk();
        $document = $this->document($response->getContent());
        $this->assertSame($title, $this->meta($document, 'og:title'));
        $this->assertSame($title, $this->meta($document, 'twitter:title'));
        $this->assertSame(__('site.page_title', ['name' => $title]), $this->title($document));
        $this->assertSame($description, $this->meta($document, 'description'));
        $this->assertSame($description, $this->meta($document, 'twitter:description'));
        $this->assertSame(asset('uploads/development.jpg'), $this->meta($document, 'og:image'));
        $this->assertSame('website', $this->meta($document, 'og:type'));
        $this->assertSame($description, $this->schemaNode($document, 'Service')['description']);
    }

    public function test_service_article_renders_a_prominent_accessible_hero_and_structured_body(): void
    {
        $this->seedPublicSite();
        $category = ServiceCategory::create([
            'name' => 'Web',
            'seo_title' => self::CATEGORY_SEO,
            'seo_description' => self::CATEGORY_DESCRIPTION,
        ]);
        Service::create([
            'title' => 'Development',
            'slug' => 'development',
            'status' => 'active',
            'service_category_id' => $category->id,
            'seo_title' => 'Development SEO',
            'seo_description' => 'A practical service description',
            'image' => 'development.jpg',
            'image_alt' => 'Development architecture illustration',
            'description' => '<p>Lead</p><p class="service-business-value"><strong>Business value:</strong> Faster delivery.</p><h3>How it works</h3><p><img src="/uploads/services/flow.svg" alt="Flow diagram" /></p>',
        ]);

        $response = $this->get('/en/service-category/web/development');

        $response->assertOk();
        $document = $this->document($response->getContent());
        $hero = $document->query('//img[contains(@class, "post-classic__image")]');
        $body = $document->query('//div[contains(@class, "service-article__body")]');

        $this->assertCount(1, $hero);
        $this->assertSame('Development architecture illustration', $hero->item(0)->attributes->getNamedItem('alt')->nodeValue);
        $this->assertSame('eager', $hero->item(0)->attributes->getNamedItem('loading')->nodeValue);
        $this->assertSame('high', $hero->item(0)->attributes->getNamedItem('fetchpriority')->nodeValue);
        $this->assertCount(1, $body);
        $this->assertSame(1, $document->query('//p[contains(@class, "service-business-value")]')->length);
        $this->assertSame(1, $body->item(0)->getElementsByTagName('h3')->length);
        $this->assertSame(1, $document->query('//figure[contains(@class, "service-diagram")]')->length);
    }

    private function title(DOMXPath $document): string
    {
        return trim((string) $document->evaluate('string(//title)'));
    }

    public function test_service_without_seo_fields_uses_its_title_and_site_description(): void
    {
        $this->seedPublicSite();
        $category = ServiceCategory::create(['name' => 'Web', 'seo_title' => self::CATEGORY_SEO, 'seo_description' => self::CATEGORY_DESCRIPTION]);
        Service::create(['title' => 'Development', 'slug' => 'development', 'status' => 'active', 'service_category_id' => $category->id]);

        $response = $this->get('/en/service-category/web/development');

        $response->assertOk();
        $document = $this->document($response->getContent());
        $this->assertSame('Development', $this->meta($document, 'og:title'));
        $this->assertSame(__('site.meta_description'), $this->meta($document, 'og:description'));
        $this->assertSame(asset('uploads/no_image.png'), $this->meta($document, 'og:image'));
    }

    #[TestWith([self::CATEGORY_SEO, self::CATEGORY_SEO])]
    #[TestWith([null, 'Web'])]
    public function test_category_keeps_its_own_metadata_and_collection_schema(?string $seoTitle, string $expectedTitle): void
    {
        $this->seedPublicSite();
        ServiceCategory::create(['name' => 'Web', 'seo_title' => $seoTitle, 'seo_description' => self::CATEGORY_DESCRIPTION]);

        $response = $this->get('/en/service-category/web');

        $response->assertOk();
        $document = $this->document($response->getContent());
        $this->assertSame($expectedTitle, $this->meta($document, 'og:title'));
        $this->assertSame(self::CATEGORY_DESCRIPTION, $this->meta($document, 'description'));
        $this->assertSame('website', $this->meta($document, 'og:type'));
        $this->assertSame($expectedTitle, $this->schemaNode($document, 'CollectionPage')['name']);
    }

    #[TestWith(['photo.jpg', self::WIDGET_IMAGE_URL])]
    #[TestWith(['/uploads/widgets/photo.jpg', self::WIDGET_IMAGE_URL])]
    #[TestWith(['uploads/widgets/photo.jpg', self::WIDGET_IMAGE_URL])]
    #[TestWith(['https://cdn.example.com/photo.jpg', 'https://cdn.example.com/photo.jpg'])]
    #[TestWith(['//cdn.example.com/photo.jpg', 'http://cdn.example.com/photo.jpg'])]
    #[TestWith([null, 'http://localhost:8100/images/bg-3-1920x480.jpg'])]
    public function test_cms_social_images_are_absolute(?string $image, string $expected): void
    {
        $this->seedPublicSite();
        $item = MenuItem::create(['name' => 'CMS', 'slug' => 'cms']);
        Page::create(['name' => self::PAGE_NAME, 'description' => 'CMS description', 'content' => '<p>Page</p>', 'menu_item_id' => $item->id]);
        if ($image !== null) {
            Widget::create(['title' => 'Image', 'subtitle' => 'cms', 'content' => '', 'widget_category_id' => config('constants.PAGES_IMAGES'), 'widget_image' => $image]);
        }

        $response = $this->get('/en/pages/cms');

        $response->assertOk();
        $document = $this->document($response->getContent());
        $this->assertSame($expected, $this->meta($document, 'og:image'));
        $this->assertSame($expected, $this->meta($document, 'twitter:image'));
        $this->assertSame(self::PAGE_NAME, $this->meta($document, 'og:title'));
        $this->assertSame('CMS description', $this->meta($document, 'description'));
        $this->assertSame(self::PAGE_NAME, $this->schemaNode($document, 'WebPage')['name']);
    }

    #[TestWith(['/uk/unknown'])]
    #[TestWith(['/uk/blog/missing'])]
    #[TestWith(['/uk/pages/missing'])]
    #[TestWith(['/uk/service-category/missing'])]
    #[TestWith(['/uk/page-not-found'])]
    #[TestWith(['/uk/service-search?search=missing'])]
    public function test_public_404_responses_are_noindex(string $path): void
    {
        $this->seedPublicSite();

        $response = $this->get($path);

        $response->assertNotFound();
        $this->assertSame('noindex', $this->meta($this->document($response->getContent()), 'robots'));
    }

    public function test_minimal_404_fallback_is_noindex(): void
    {
        view()->share('headerNavBarContent', null);
        view()->share('footerBottomBarContent', null);

        $response = $this->get('/uk/missing-without-chrome');

        $response->assertNotFound();
        $this->assertSame('noindex', $this->meta($this->document($response->getContent()), 'robots'));
    }

    public function test_ordinary_pages_remain_indexable(): void
    {
        $this->seedPublicSite();

        $response = $this->get('/pl/about');

        $response->assertOk();
        $this->assertSame('', $this->meta($this->document($response->getContent()), 'robots'));
    }

    public function test_successful_search_remains_noindex(): void
    {
        $this->seedPublicSite();
        $this->createPost();

        $response = $this->get('/en/blog-search?search=Article');

        $response->assertOk();
        $this->assertSame('noindex', $this->meta($this->document($response->getContent()), 'robots'));
    }

    #[TestWith(['en', 'faq', 'meta_description_faq'])]
    #[TestWith(['uk', 'support', 'meta_description_support'])]
    #[TestWith(['pl', 'privacy-policy', 'meta_description_privacy'])]
    public function test_short_static_page_descriptions_use_localized_seo_fallback(
        string $locale,
        string $slug,
        string $translationKey,
    ): void {
        $this->seedPublicSite();

        $response = $this->get("/$locale/$slug");

        $response->assertOk();
        $this->assertSame(
            __("site.$translationKey"),
            $this->meta($this->document($response->getContent()), 'description'),
        );
    }

    private function createPost(): Post
    {
        $author = User::factory()->create();
        $category = Category::create(['name' => 'News', 'slug' => 'news', 'description' => 'News', 'user_id' => $author->id]);

        return Post::create([
            'name' => 'Article', 'slug' => 'article', 'description' => 'Article description', 'content' => '<p>Article</p>',
            'status' => 'published', 'category_id' => $category->id, 'user_id' => $author->id,
            'img_path' => '/uploads/article.jpg', 'created_at' => '2026-09-01 12:00:00',
        ]);
    }

    private function document(string $html): DOMXPath
    {
        $document = new DOMDocument;
        @$document->loadHTML('<?xml encoding="UTF-8">'.$html);

        return new DOMXPath($document);
    }

    private function meta(DOMXPath $document, string $name): string
    {
        return $document->evaluate('string(//head/meta[@name="'.$name.'" or @property="'.$name.'"]/@content)');
    }

    /** @return array<string, mixed> */
    private function schemaNode(DOMXPath $document, string $type): array
    {
        $nodes = $document->query('//script[@type="application/ld+json"]');
        $this->assertCount(1, $nodes);
        $graph = json_decode($nodes->item(0)->textContent, true, flags: JSON_THROW_ON_ERROR);
        $matches = array_values(array_filter($graph['@graph'], fn (array $node): bool => $node['@type'] === $type));
        $this->assertCount(1, $matches);

        return $matches[0];
    }
}
