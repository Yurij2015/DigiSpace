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
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\Feature\Concerns\SeedsPublicSite;
use Tests\TestCase;

class PublicSeoTest extends TestCase
{
    use RefreshDatabase;

    private const BLOG_TITLE = 'DigiSpace | Blog';

    private const CATEGORY_DESCRIPTION = 'Category description';

    private const CATEGORY_SEO = 'Category SEO';

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
        $this->assertSame(asset('images/og-default.png'), $this->meta($document, 'og:image'));
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
        $this->assertSame(Storage::disk('s3')->url('posts/article.jpg'), $this->meta($document, 'og:image'));
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
            'seo_title' => 'Service SEO', 'seo_description' => 'Service description', 'image' => 'services/development.jpg',
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
        $this->assertSame(Storage::disk('s3')->url('services/development.jpg'), $this->meta($document, 'og:image'));
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
            'image' => 'services/development.jpg',
            'image_alt' => 'Development architecture illustration',
            'description' => '<p>Lead</p><div class="lead"><p><strong>Business value:</strong> Faster delivery.</p></div><h3>How it works</h3><p><img src="'.Storage::disk('s3')->url('services/flow.svg').'" alt="Flow diagram" /></p>',
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
        $this->assertSame(1, $document->query('//div[contains(concat(" ", normalize-space(@class), " "), " lead ")]')->length);
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
        $this->assertSame(Storage::disk('s3')->url('services/no_image.png'), $this->meta($document, 'og:image'));
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

    #[TestWith(['widgets/photo.jpg'])]
    #[TestWith(['https://cdn.example.com/photo.jpg'])]
    #[TestWith([null])]
    public function test_cms_social_images_are_absolute(?string $image): void
    {
        $expected = match (true) {
            $image === null => asset('images/og-default.png'),
            str_starts_with($image, 'https://') => $image,
            default => asset(Storage::disk('s3')->url($image)),
        };
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

    public function test_faq_page_publishes_schema_from_its_editable_content(): void
    {
        $this->seedPublicSite();
        Page::where('slug', 'faq')->update([
            'content' => '<h5>What is a service?</h5><p>A structured answer.</p><h5>How do we start?</h5><p>Send us a brief.</p>',
        ]);

        $response = $this->get('/uk/faq');

        $response->assertOk();
        $faq = $this->schemaNode($this->document($response->getContent()), 'FAQPage');
        $this->assertCount(2, $faq['mainEntity']);
        $this->assertSame('What is a service?', $faq['mainEntity'][0]['name']);
        $this->assertSame('A structured answer.', $faq['mainEntity'][0]['acceptedAnswer']['text']);
    }

    public function test_pricing_page_renders_the_service_price_matrix(): void
    {
        $this->seedPublicSite();
        Page::create(['slug' => 'pricing', 'name' => 'Pricing', 'description' => 'Our prices']);
        $category = ServiceCategory::create(['name' => 'Backend']);
        Service::create([
            'title' => 'Laravel development',
            'slug' => 'laravel',
            'status' => 'active',
            'service_category_id' => $category->id,
            'price' => 1500,
            'details' => 'Custom apps on Laravel',
            'timeline' => '4–8 weeks',
        ]);
        Service::create([
            'title' => 'Unpriced service',
            'slug' => 'unpriced',
            'status' => 'active',
            'service_category_id' => $category->id,
        ]);

        $response = $this->get('/en/pricing');

        $response->assertOk();
        $document = $this->document($response->getContent());
        $rows = $document->query('//a[contains(concat(" ", normalize-space(@class), " "), " price-matrix__row ")]');

        $this->assertSame(1, $rows->length);
        $this->assertStringContainsString('/en/service-category/backend/laravel', (string) $rows->item(0)->attributes->getNamedItem('href')->nodeValue);
        $this->assertSame('Custom apps on Laravel', trim((string) $document->evaluate('string(.//span[contains(@class, "price-matrix__details")])', $rows->item(0))));
        $this->assertSame('4–8 weeks', trim((string) $document->evaluate('string(.//span[contains(@class, "price-matrix__timeline")])', $rows->item(0))));
        $price = preg_replace('/\s+/', ' ', trim((string) $document->evaluate('string(.//span[contains(@class, "price-matrix__price")])', $rows->item(0))));
        $this->assertSame(__('site.price_from').' $1,500', $price);
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
            'img_path' => 'posts/article.jpg', 'created_at' => '2026-09-01 12:00:00',
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
