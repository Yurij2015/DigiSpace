<?php

namespace Tests\Unit\Services\AI;

use App\Services\AI\ArticlePromptBuilder;
use PHPUnit\Framework\TestCase;

class ArticlePromptBuilderTest extends TestCase
{
    private ArticlePromptBuilder $builder;

    protected function setUp(): void
    {
        parent::setUp();
        $this->builder = new ArticlePromptBuilder;
    }

    public function test_it_builds_prompt_with_english_locale_and_professional_style(): void
    {
        $result = $this->builder->build(
            entityDescription: 'Blog post for software developers',
            fields: ['name', 'content'],
            seoFields: ['description', 'keywords'],
            userPrompt: 'Write about Laravel 13 features',
            locale: 'en',
            writingStyle: 'Professional',
            keywords: 'laravel, php',
        );

        $this->assertArrayHasKey('system_prompt', $result);
        $this->assertArrayHasKey('prompt', $result);

        // Verify system prompt
        $this->assertStringContainsString('Blog post for software developers', $result['system_prompt']);
        $this->assertStringContainsString('semantic HTML', $result['system_prompt']);
        $this->assertStringContainsString('["name","content","description","keywords"]', $result['system_prompt']);

        // Verify user prompt
        $this->assertStringContainsString('Target Locale: en', $result['prompt']);
        $this->assertStringContainsString('Target language: English', $result['prompt']);
        $this->assertStringContainsString('Professional', $result['prompt']);
        $this->assertStringContainsString('SEO Keywords to naturally incorporate: laravel, php', $result['prompt']);
        $this->assertStringContainsString('Write about Laravel 13 features', $result['prompt']);
    }

    public function test_it_incorporates_ukrainian_and_polish_instructions(): void
    {
        $ukResult = $this->builder->build(
            entityDescription: 'Статті та новини',
            fields: ['name', 'content'],
            seoFields: ['description'],
            userPrompt: 'Штучний інтелект у розробці',
            locale: 'uk',
            writingStyle: 'Engaging',
        );

        $this->assertStringContainsString('Українська', $ukResult['prompt']);
        $this->assertStringContainsStringIgnoringCase('engaging', $ukResult['prompt']);

        $plResult = $this->builder->build(
            entityDescription: 'Artykuły i wpisy blogowe',
            fields: ['name', 'content'],
            seoFields: ['description'],
            userPrompt: 'Sztuczna inteligencja w programowaniu',
            locale: 'pl',
            writingStyle: 'Technical',
        );

        $this->assertStringContainsString('Polski', $plResult['prompt']);
        $this->assertStringContainsStringIgnoringCase('technical', $plResult['prompt']);
    }
}
