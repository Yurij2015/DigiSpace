<?php

namespace Tests\Feature;

use App\Support\Locales;
use DOMDocument;
use DOMXPath;
use Tests\TestCase;

class DevelopmentIndexTest extends TestCase
{
    public function test_development_index_lists_localized_landing_pages(): void
    {
        $landings = [
            'saas',
            'business',
            'laravel',
            'symfony',
            'api-integrations',
            'php-support',
            'php-audit',
        ];

        foreach (config('locales.supported') as $locale) {
            $response = $this->get(route('development.index', ['locale' => $locale]));

            $response->assertViewIs('development.index')
                ->assertSee(__('development.index.hero.title', [], $locale));
            $this->assertSame("/{$locale}/development", Locales::localizedPath('/development', $locale));

            foreach ($landings as $landing) {
                $response->assertSee(route('development.'.$landing, ['locale' => $locale]), false)
                    ->assertSee(__($landing.'.hero.title', [], $locale));
            }
        }
    }

    public function test_development_index_has_localized_social_previews(): void
    {
        foreach (['en', 'uk', 'pl'] as $locale) {
            $imagePath = "landing/og-development-{$locale}.png";
            $this->assertFileExists(public_path($imagePath));
            $this->assertSame([1200, 630], array_slice(getimagesize(public_path($imagePath)), 0, 2));
            $image = asset($imagePath).'?v='.filemtime(public_path($imagePath));
            $expected = [
                'og:type' => 'website',
                'og:url' => route('development.index', ['locale' => $locale]),
                'og:title' => __('development.index.seo.title', [], $locale),
                'og:description' => __('development.index.seo.description', [], $locale),
                'og:image' => $image,
                'og:image:width' => '1200',
                'og:image:height' => '630',
                'og:site_name' => 'DigiSpace',
                'twitter:card' => 'summary_large_image',
                'twitter:title' => __('development.index.seo.title', [], $locale),
                'twitter:description' => __('development.index.seo.description', [], $locale),
                'twitter:image' => $image,
            ];

            $response = $this->get("/{$locale}/development")->assertOk();
            $document = new DOMDocument;
            $previous = libxml_use_internal_errors(true);
            $document->loadHTML($response->getContent());
            libxml_clear_errors();
            libxml_use_internal_errors($previous);
            $xpath = new DOMXPath($document);

            foreach ($expected as $name => $content) {
                $attribute = str_starts_with($name, 'og:') ? 'property' : 'name';
                $tags = $xpath->query("//meta[@{$attribute}='{$name}']");
                $this->assertCount(1, $tags, "{$locale}: {$name}");
                $this->assertSame($content, $tags->item(0)->getAttribute('content'), "{$locale}: {$name}");
            }
        }
    }
}
