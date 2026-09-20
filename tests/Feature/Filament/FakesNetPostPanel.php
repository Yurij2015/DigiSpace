<?php

namespace Tests\Feature\Filament;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Http;

/**
 * Shared NetPostPanel test double: service config, a succeeded Http::fake
 * response and a helper for a post bound to a fresh category.
 */
trait FakesNetPostPanel
{
    private const MOCK_TITLE = 'Mock Generated Title: AI & Future of Cloud Computing';

    private const MOCK_DESCRIPTION = 'A comprehensive overview of cloud computing architectures and modern engineering patterns.';

    protected function fakeNetPostPanel(string $endpoint): void
    {
        config()->set('services.netpostpanel.url', 'https://net-post-panel.test');
        config()->set('services.netpostpanel.key', 'test-api-key');

        Http::fake([
            "net-post-panel.test/api/v1/{$endpoint}" => Http::response([
                'request_id' => 'req-uuid',
                'status' => 'succeeded',
                'payload' => [
                    'name' => self::MOCK_TITLE,
                    'description' => self::MOCK_DESCRIPTION,
                    'meta' => 'Cloud Computing Architecture | DigiSpace',
                    'content' => '<p>Mock Content</p>',
                ],
            ], 200),
        ]);
    }

    protected function createPostInCategory(User $admin, array $attributes = []): Post
    {
        $category = Category::create([
            'name' => 'Technology',
            'slug' => 'technology',
            'description' => 'Technology',
            'user_id' => $admin->id,
        ]);

        return Post::create(array_merge([
            'name' => 'Deep Dive into Cloud Computing',
            'slug' => 'deep-dive-into-cloud-computing',
            'content' => '<p>Cloud computing provides scalable infrastructure.</p>',
            'category_id' => $category->id,
            'user_id' => $admin->id,
        ], $attributes));
    }
}
