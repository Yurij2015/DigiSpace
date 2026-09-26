<?php

namespace Tests\Feature\Filament;

use App\Filament\Resources\BlogPostBanners\Pages\CreateBlogPostBanner;
use App\Filament\Resources\Posts\Pages\CreatePost;
use App\Filament\Resources\Services\Pages\CreateService;
use App\Filament\Resources\Widgets\Pages\CreateWidget;
use App\Models\BlogPostBanner;
use App\Models\Category;
use App\Models\Post;
use App\Models\Service;
use App\Models\Widget;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class ContentImageUploadTest extends TestCase
{
    use MakesFilamentAdmin;
    use RefreshDatabase;

    public function test_post_cover_image_is_stored_on_s3_and_saved_as_an_object_key(): void
    {
        Storage::fake('s3');
        $user = $this->actingAsFilamentAdmin();
        $category = Category::create(['name' => 'News', 'slug' => 'news', 'description' => 'News', 'user_id' => $user->id]);

        Livewire::test(CreatePost::class)
            ->fillForm([
                'name' => 'Cover test',
                'content' => '<p>Body</p>',
                'category_id' => $category->id,
                'status' => 'draft',
            ])
            ->set('data.img_path', UploadedFile::fake()->image('cover.png', 400, 300))
            ->call('create')
            ->assertHasNoFormErrors();

        $key = Post::latest('id')->first()->getRawOriginal('img_path');
        self::assertStringStartsWith('posts/', $key);
        Storage::disk('s3')->assertExists($key);
    }

    public function test_widget_image_is_stored_on_s3_and_saved_as_an_object_key(): void
    {
        Storage::fake('s3');
        $this->actingAsFilamentAdmin();
        $categoryId = DB::table('widget_categories')->insertGetId(['title' => 'Footer', 'name' => 'footer', 'description' => 'Footer', 'created_at' => now(), 'updated_at' => now()]);

        Livewire::test(CreateWidget::class)
            ->fillForm([
                'title' => 'Widget test',
                'widget_category_id' => $categoryId,
                'content' => '<p>Widget</p>',
            ])
            ->set('data.widget_image', UploadedFile::fake()->image('widget.png', 400, 300))
            ->call('create')
            ->assertHasNoFormErrors();

        $key = Widget::latest('id')->first()->getRawOriginal('widget_image');
        self::assertStringStartsWith('widgets/', $key);
        Storage::disk('s3')->assertExists($key);
    }

    public function test_service_image_is_stored_on_s3_and_saved_as_an_object_key(): void
    {
        Storage::fake('s3');
        $this->actingAsFilamentAdmin();

        Livewire::test(CreateService::class)
            ->fillForm([
                'title' => 'Service test',
                'status' => 'active',
            ])
            ->set('data.image', UploadedFile::fake()->image('service.png', 400, 300))
            ->call('create')
            ->assertHasNoFormErrors();

        $key = Service::latest('id')->first()->getRawOriginal('image');
        self::assertStringStartsWith('services/', $key);
        Storage::disk('s3')->assertExists($key);
    }

    public function test_blog_banner_image_is_stored_on_s3_and_saved_as_an_object_key(): void
    {
        Storage::fake('s3');
        $this->actingAsFilamentAdmin();

        Livewire::test(CreateBlogPostBanner::class)
            ->set('data.img_path', UploadedFile::fake()->image('banner.png', 400, 300))
            ->call('create')
            ->assertHasNoFormErrors();

        $key = BlogPostBanner::latest('id')->first()->getRawOriginal('img_path');
        self::assertStringStartsWith('banners/', $key);
        Storage::disk('s3')->assertExists($key);
    }
}
