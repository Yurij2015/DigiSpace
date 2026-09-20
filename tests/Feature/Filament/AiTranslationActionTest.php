<?php

namespace Tests\Feature\Filament;

use App\Filament\Resources\Pages\Pages\EditPage;
use App\Filament\Resources\Posts\Pages\CreatePost;
use App\Filament\Resources\Posts\Pages\EditPost;
use App\Models\Page;
use Database\Seeders\GenerationConfigSeeder;
use Filament\Actions\Testing\TestAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AiTranslationActionTest extends TestCase
{
    use FakesNetPostPanel;
    use MakesFilamentAdmin;
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(GenerationConfigSeeder::class);
        $this->fakeNetPostPanel('translate');
    }

    public function test_ai_translation_populates_ukrainian_fields_from_english_post(): void
    {
        $admin = $this->actingAsFilamentAdmin();
        $post = $this->createPostInCategory($admin, [
            'description' => 'A detailed look at cloud systems',
            'keywords' => 'cloud, devops',
        ]);

        $action = TestAction::make('translateWithAi_uk')->schemaComponent(true, 'form');

        Livewire::test(EditPost::class, ['record' => $post->getRouteKey()])
            ->mountAction($action)
            ->set('mountedActions.0.data.translation_mode', 'adapted')
            ->callMountedAction()
            ->assertHasNoActionErrors()
            ->assertSchemaStateSet([
                'translations.uk.name' => self::MOCK_TITLE,
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
                'translations.pl.name' => self::MOCK_TITLE,
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
