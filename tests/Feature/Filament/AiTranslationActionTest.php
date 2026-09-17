<?php

namespace Tests\Feature\Filament;

use App\Filament\Resources\Pages\Pages\EditPage;
use App\Filament\Resources\Posts\Pages\CreatePost;
use App\Filament\Resources\Posts\Pages\EditPost;
use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use Database\Seeders\GenerationConfigSeeder;
use Filament\Actions\Testing\TestAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class AiTranslationActionTest extends TestCase
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
            'net-post-panel.test/api/v1/translate' => Http::response([
                'payload' => [
                    'name' => 'Mock Generated Title: AI & Future of Cloud Computing',
                    'description' => 'A comprehensive overview of cloud computing architectures and modern engineering patterns.',
                    'meta' => 'Cloud Computing Architecture | DigiSpace',
                    'content' => '<p>Mock Content</p>',
                ],
            ], 200),
        ]);
    }

    public function test_ai_translation_populates_ukrainian_fields_from_english_post(): void
    {
        $admin = $this->actingAsFilamentAdmin();
        $category = Category::create([
            'name' => 'Technology',
            'slug' => 'technology',
            'description' => 'Technology',
            'user_id' => $admin->id,
        ]);

        $post = Post::create([
            'name' => 'Deep Dive into Cloud Computing',
            'slug' => 'deep-dive-into-cloud-computing',
            'content' => '<p>Cloud computing provides scalable infrastructure.</p>',
            'description' => 'A detailed look at cloud systems',
            'keywords' => 'cloud, devops',
            'category_id' => $category->id,
            'user_id' => $admin->id,
        ]);

        $action = TestAction::make('translateWithAi_uk')->schemaComponent(true, 'form');

        Livewire::test(EditPost::class, ['record' => $post->getRouteKey()])
            ->mountAction($action)
            ->set('mountedActions.0.data.translation_mode', 'adapted')
            ->callMountedAction()
            ->assertHasNoActionErrors()
            ->assertSchemaStateSet([
                'translations.uk.name' => 'Mock Generated Title: AI & Future of Cloud Computing',
            ]);

        $this->assertDatabaseHas('generation_attempts', [
            'type' => 'translation',
            'entity_type' => 'post',
            'locale' => 'uk',
            'translation_mode' => 'adapted',
            'generatable_id' => $post->id,
        ]);
    }

    public function test_ai_translation_populates_polish_fields_from_english_page(): void
    {
        $this->actingAsFilamentAdmin();

        $page = Page::create([
            'name' => 'About Our Agency',
            'slug' => 'about-our-agency',
            'content' => '<p>We are a leading digital transformation agency.</p>',
            'description' => 'Learn about our mission and team',
            'keywords' => 'agency, digital, mission',
            'meta' => 'About | DigiSpace',
        ]);

        $action = TestAction::make('translateWithAi_pl')->schemaComponent(true, 'form');

        Livewire::test(EditPage::class, ['record' => $page->getRouteKey()])
            ->mountAction($action)
            ->set('mountedActions.0.data.translation_mode', 'literal')
            ->callMountedAction()
            ->assertHasNoActionErrors()
            ->assertSchemaStateSet([
                'translations.pl.name' => 'Mock Generated Title: AI & Future of Cloud Computing',
            ]);

        $this->assertDatabaseHas('generation_attempts', [
            'type' => 'translation',
            'entity_type' => 'page',
            'locale' => 'pl',
            'translation_mode' => 'literal',
            'generatable_id' => $page->id,
        ]);
    }

    public function test_ai_translation_is_disabled_on_new_unsaved_record(): void
    {
        $this->actingAsFilamentAdmin();

        $action = TestAction::make('translateWithAi_uk')->schemaComponent(true, 'form');

        Livewire::test(CreatePost::class)
            ->assertActionDisabled($action);
    }
}
