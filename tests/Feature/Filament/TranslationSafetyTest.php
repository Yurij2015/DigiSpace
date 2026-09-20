<?php

namespace Tests\Feature\Filament;

use App\Filament\Resources\Pages\Pages\EditPage;
use App\Filament\Resources\Posts\Pages\EditPost;
use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * Regression for the code-review finding: with the panel UI in uk/pl the locale-aware
 * accessors used to pre-fill the English tab with the translation, and Save then
 * overwrote the base columns and slug.
 */
class TranslationSafetyTest extends TestCase
{
    use MakesFilamentAdmin;
    use RefreshDatabase;

    private const UK_NAME = 'Українська назва';

    private const PL_NAME = 'O nas';

    /** PostPolicy::update allows only the author, so the post belongs to the acting admin. */
    private function makePost(User $author): Post
    {
        $category = Category::create(['name' => 'News', 'slug' => 'news', 'description' => 'News', 'user_id' => $author->id]);

        return Post::create([
            'name' => 'English title',
            'slug' => 'english-title',
            'content' => '<p>English body</p>',
            'description' => 'English description',
            'keywords' => 'en',
            'status' => 'published',
            'category_id' => $category->id,
            'user_id' => $author->id,
            'translations' => ['uk' => ['name' => self::UK_NAME, 'content' => '<p>Український текст</p>']],
        ]);
    }

    public function test_post_edit_form_shows_base_values_while_the_panel_is_in_ukrainian(): void
    {
        $post = $this->makePost($this->actingAsFilamentAdmin());
        app()->setLocale('uk');

        self::assertSame(self::UK_NAME, $post->fresh()->name, 'accessor sanity: public reads see the translation');

        Livewire::test(EditPost::class, ['record' => $post->getRouteKey()])
            ->assertSchemaStateSet([
                'name' => 'English title',
                'content' => '<p>English body</p>',
                'translations.uk.name' => self::UK_NAME,
                'translations.uk.content' => '<p>Український текст</p>',
            ]);
    }

    public function test_saving_without_changes_leaves_the_post_untouched(): void
    {
        $post = $this->makePost($this->actingAsFilamentAdmin());
        $before = $post->fresh()->getRawOriginal();
        app()->setLocale('uk');

        Livewire::test(EditPost::class, ['record' => $post->getRouteKey()])
            ->call('save')
            ->assertHasNoFormErrors();

        $after = $post->fresh()->getRawOriginal();

        foreach (['name', 'content', 'description', 'keywords', 'slug'] as $column) {
            self::assertSame($before[$column], $after[$column], "$column changed on save");
        }
        // MySQL normalises JSON whitespace on write; compare the decoded structure.
        self::assertSame(json_decode($before['translations'], true), json_decode($after['translations'], true), 'translations changed on save');
    }

    public function test_page_edit_form_shows_base_values_while_the_panel_is_in_polish(): void
    {
        $this->actingAsFilamentAdmin();
        $page = Page::create([
            'name' => 'About', 'slug' => 'about', 'meta' => 'meta', 'description' => 'desc', 'content' => '<p>About us</p>',
            'translations' => ['pl' => ['name' => self::PL_NAME, 'content' => '<p>O nas treść</p>']],
        ]);
        $before = $page->fresh()->getRawOriginal();
        app()->setLocale('pl');

        Livewire::test(EditPage::class, ['record' => $page->getRouteKey()])
            ->assertSchemaStateSet(['name' => 'About', 'content' => '<p>About us</p>', 'translations.pl.name' => self::PL_NAME])
            ->call('save')
            ->assertHasNoFormErrors();

        $after = $page->fresh()->getRawOriginal();
        foreach (['name', 'content', 'slug'] as $column) {
            self::assertSame($before[$column], $after[$column], "$column changed on save");
        }
        self::assertSame(json_decode($before['translations'], true), json_decode($after['translations'], true), 'translations changed on save');
    }

    public function test_blank_rich_editor_output_is_not_stored_as_a_translation(): void
    {
        $page = Page::create([
            'name' => 'About', 'slug' => 'about-2', 'meta' => 'meta', 'description' => 'desc', 'content' => '<p>About us</p>',
            'translations' => ['uk' => ['name' => null, 'content' => '<p></p>', 'meta' => ''], 'pl' => ['name' => self::PL_NAME]],
        ]);

        self::assertSame(['pl' => ['name' => self::PL_NAME]], $page->fresh()->translations);

        app()->setLocale('uk');
        self::assertSame('<p>About us</p>', $page->fresh()->content, 'blank uk content must fall back to the base value');
    }

    public function test_translatable_lists_cover_every_localized_accessor(): void
    {
        foreach ([Post::class, Page::class, Category::class, Service::class, ServiceCategory::class, Product::class] as $model) {
            $source = file_get_contents((new \ReflectionClass($model))->getFileName());
            preg_match_all("/localizedAttribute\\('([a-z_]+)'\\)/", $source, $m);

            self::assertEqualsCanonicalizing($m[1], $model::TRANSLATABLE, "$model::TRANSLATABLE drifted from its accessors");
        }
    }
}
