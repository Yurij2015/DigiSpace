<?php

namespace Tests\Feature;

use DOMDocument;
use DOMXPath;
use Tests\TestCase;

class DevelopmentShowcaseTest extends TestCase
{
    public function test_each_landing_shows_relevant_localized_product_screens_with_existing_assets(): void
    {
        $primaryScreens = [
            'saas' => 'vetspace-clinic-month',
            'business' => 'vetspace-clinic-calendar',
            'laravel' => 'vetspace-admin-plans',
            'api-integrations' => 'vetspace-swagger-appointments',
            'php-support' => 'digipulse-history',
        ];

        foreach (config('locales.supported') as $locale) {
            foreach ($primaryScreens as $landing => $screen) {
                $response = $this->get("/{$locale}/development/{$landing}");
                $response->assertOk();

                $document = new DOMDocument;
                $previous = libxml_use_internal_errors(true);
                $document->loadHTML($response->getContent());
                libxml_clear_errors();
                libxml_use_internal_errors($previous);
                $xpath = new DOMXPath($document);

                $main = $xpath->query('//*[@data-hero-shot="main"]')->item(0);
                $this->assertNotNull($main, "{$landing}/{$locale} has no main showcase image");
                $image = $xpath->query('.//img', $main)->item(0);
                $this->assertNotNull($image);
                $this->assertStringEndsWith("/landing/screens/{$screen}-800.webp", $image->getAttribute('src'));
                $this->assertNotEmpty($image->getAttribute('alt'));
                $caption = $xpath->query('./figcaption', $main)->item(0);
                $this->assertNotNull($caption);
                $this->assertStringContainsString($image->getAttribute('alt'), $caption->textContent);

                foreach ($xpath->query('//*[@data-hero-showcase]//img') as $showcaseImage) {
                    $this->assertFileExists(public_path(ltrim(parse_url($showcaseImage->getAttribute('src'), PHP_URL_PATH), '/')));
                }
            }
        }
    }

    public function test_audit_and_symfony_use_honestly_labelled_illustrations_in_each_language(): void
    {
        foreach (config('locales.supported') as $locale) {
            foreach (['php-audit', 'symfony'] as $landing) {
                $response = $this->get("/{$locale}/development/{$landing}");

                $response->assertOk()
                    ->assertSee("data-hero-illustration=\"{$landing}\"", false)
                    ->assertSee(__("development.showcase.{$landing}.description", [], $locale));
            }

            $this->get("/{$locale}/development/symfony")
                ->assertSee(__('development.showcase.symfony.projects_note', [], $locale));
        }
    }
}
