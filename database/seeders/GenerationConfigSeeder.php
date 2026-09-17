<?php

namespace Database\Seeders;

use App\Models\GenerationConfig;
use Illuminate\Database\Seeder;

class GenerationConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $configs = [
            [
                'entity_type' => 'post',
                'entity_name' => 'Blog Post',
                'entity_description' => 'Articles and blog stories intended for reader engagement and SEO discovery on technology, software development, design, and digital solutions.',
                'fields' => ['name', 'content'],
                'seo_fields' => ['description', 'keywords'],
                'default_prompt' => 'Write an insightful, well-structured blog post about: {prompt}. Writing style: {writingStyle}. Keywords to incorporate naturally: {keywords}.',
                'system_prompt' => 'You are an expert tech blog writer and SEO specialist. Produce engaging, high-quality content formatted in clean semantic HTML (h2, h3, p, ul, ol, li, blockquote, code) for the content body. Do not include markdown code block wrappers (like ```html).',
            ],
            [
                'entity_type' => 'page',
                'entity_name' => 'CMS Page',
                'entity_description' => 'Informational website pages describing company services, landing pages, about pages, and business offerings.',
                'fields' => ['name', 'content'],
                'seo_fields' => ['description', 'keywords', 'meta'],
                'default_prompt' => 'Create complete, professional website page content for: {prompt}. Writing style: {writingStyle}. Keywords: {keywords}.',
                'system_prompt' => 'You are a professional website copywriter and CRO specialist. Output semantic HTML (h2, h3, p, ul, ol, li, strong, blockquote) suitable for a CMS page. Do not include markdown code block wrappers (like ```html).',
            ],
        ];

        foreach ($configs as $config) {
            GenerationConfig::updateOrCreate(
                ['entity_type' => $config['entity_type']],
                $config
            );
        }
    }
}
