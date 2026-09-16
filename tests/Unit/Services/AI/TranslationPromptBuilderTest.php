<?php

namespace Tests\Unit\Services\AI;

use App\Services\AI\TranslationPromptBuilder;
use PHPUnit\Framework\TestCase;

class TranslationPromptBuilderTest extends TestCase
{
    private TranslationPromptBuilder $builder;

    protected function setUp(): void
    {
        parent::setUp();
        $this->builder = new TranslationPromptBuilder;
    }

    public function test_it_builds_adapted_translation_prompt_for_ukrainian(): void
    {
        $sourceContent = [
            'name' => 'Getting Started with Docker',
            'content' => '<p>Docker simplifies containerization.</p>',
            'description' => 'A guide to Docker containers',
        ];

        $result = $this->builder->build(
            entityDescription: 'Technical Blog Post',
            fields: ['name', 'content'],
            seoFields: ['description'],
            sourceContent: $sourceContent,
            targetLocale: 'uk',
            translationMode: 'adapted',
        );

        $this->assertArrayHasKey('system_prompt', $result);
        $this->assertArrayHasKey('prompt', $result);

        // System prompt checks
        $this->assertStringContainsString('Technical Blog Post', $result['system_prompt']);
        $this->assertStringContainsString('Adapted', $result['system_prompt']);
        $this->assertStringContainsString('Ukrainian', $result['system_prompt']);
        $this->assertStringContainsString('["name","content","description"]', $result['system_prompt']);

        // User prompt checks
        $this->assertStringContainsString('Getting Started with Docker', $result['prompt']);
        $this->assertStringContainsString('Target Locale: uk', $result['prompt']);
        $this->assertStringContainsString('Adapted', $result['prompt']);
    }

    public function test_it_builds_literal_translation_prompt_for_polish(): void
    {
        $sourceContent = [
            'name' => 'About Us',
            'content' => '<p>We are a digital agency.</p>',
        ];

        $result = $this->builder->build(
            entityDescription: 'CMS Page',
            fields: ['name', 'content'],
            seoFields: [],
            sourceContent: $sourceContent,
            targetLocale: 'pl',
            translationMode: 'literal',
        );

        // Verify literal mode and Polish instructions
        $this->assertStringContainsString('Literal', $result['system_prompt']);
        $this->assertStringContainsString('Polish', $result['system_prompt']);
        $this->assertStringContainsString('Target Locale: pl', $result['prompt']);
        $this->assertStringContainsString('We are a digital agency.', $result['prompt']);
    }
}
