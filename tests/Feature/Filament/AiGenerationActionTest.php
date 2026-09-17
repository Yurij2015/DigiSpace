<?php

namespace Tests\Feature\Filament;

use App\Filament\Resources\Pages\Pages\CreatePage;
use App\Filament\Resources\Posts\Pages\CreatePost;
use App\Filament\Resources\Posts\Pages\EditPost;
use App\Models\Category;
use App\Models\Post;
use Database\Seeders\GenerationConfigSeeder;
use Filament\Actions\Testing\TestAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class AiGenerationActionTest extends TestCase
{
    use MakesFilamentAdmin;
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(GenerationConfigSeeder::class);

        config()->set('services.netpostpanel.url', 'https://net-post-panel.test');
        config()->set('services.netpostpanel.key', 'test-api-key');

        Http::fake([
            'net-post-panel.test/api/v1/generate' => Http::response([
                'request_id' => 'req-uuid-gen',
                'status' => 'succeeded',
                'payload' => [
                    'name' => 'Mock Generated Title: AI & Future of Cloud Computing',
                    'description' => 'A comprehensive overview of cloud computing architectures and modern engineering patterns.',
                    'meta' => 'Cloud Computing Architecture | DigiSpace',
                    'content' => '<p>Mock Content</p>',
                ],
            ], 200),
        ]);
    }

    public function test_ai_generation_populates_english_post_form_non_destructively(): void
    {
        $this->actingAsFilamentAdmin();

        $action = TestAction::make('generateWithAi_en')->schemaComponent(true, 'form');

        Livewire::test(CreatePost::class)
            ->mountAction($action)
            ->set('mountedActions.0.data.prompt', 'Write about modern PHP architecture')
            ->set('mountedActions.0.data.locale', 'en')
            ->set('mountedActions.0.data.writing_style', 'Professional')
            ->callMountedAction()
            ->assertHasNoActionErrors()
            ->assertSchemaStateSet([
                'name' => 'Mock Generated Title: AI & Future of Cloud Computing',
                'description' => 'A comprehensive overview of cloud computing architectures and modern engineering patterns.',
            ]);

        $this->assertDatabaseCount('posts', 0);

        $this->assertDatabaseHas('generation_attempts', [
            'type' => 'generation',
            'entity_type' => 'post',
            'locale' => 'en',
            'user_prompt' => 'Write about modern PHP architecture',
        ]);
    }

    public function test_ai_generation_populates_ukrainian_tab_on_post(): void
    {
        $admin = $this->actingAsFilamentAdmin();
        $category = Category::create([
            'name' => 'Tech',
            'slug' => 'tech',
            'description' => 'Tech',
            'user_id' => $admin->id,
        ]);

        $post = Post::create([
            'name' => 'Existing Post',
            'slug' => 'existing-post',
            'content' => '<p>English body</p>',
            'category_id' => $category->id,
            'user_id' => $admin->id,
        ]);

        $action = TestAction::make('generateWithAi_uk')->schemaComponent(true, 'form');

        Livewire::test(EditPost::class, ['record' => $post->getRouteKey()])
            ->mountAction($action)
            ->set('mountedActions.0.data.prompt', 'Напиши статтю про хмарні технології')
            ->set('mountedActions.0.data.locale', 'uk')
            ->set('mountedActions.0.data.writing_style', 'Engaging')
            ->callMountedAction()
            ->assertHasNoActionErrors()
            ->assertSchemaStateSet([
                'translations.uk.name' => 'Mock Generated Title: AI & Future of Cloud Computing',
            ]);
    }

    public function test_ai_generation_populates_page_form_including_meta(): void
    {
        $this->actingAsFilamentAdmin();

        $action = TestAction::make('generateWithAi_en')->schemaComponent(true, 'form');

        Livewire::test(CreatePage::class)
            ->mountAction($action)
            ->set('mountedActions.0.data.prompt', 'Create an About Us page')
            ->set('mountedActions.0.data.locale', 'en')
            ->set('mountedActions.0.data.writing_style', 'Professional')
            ->callMountedAction()
            ->assertHasNoActionErrors()
            ->assertSchemaStateSet([
                'name' => 'Mock Generated Title: AI & Future of Cloud Computing',
                'meta' => 'Cloud Computing Architecture | DigiSpace',
            ]);

        $this->assertDatabaseCount('pages', 0);
    }
}
