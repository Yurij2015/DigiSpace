<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\Feature\Concerns\SeedsPublicSite;
use Tests\TestCase;

class FileUploadValidationTest extends TestCase
{
    use RefreshDatabase;
    use SeedsPublicSite;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seedPublicSite();

        $this->admin = User::factory()->create([
            'email' => 'admin@example.test',
            'email_verified_at' => now(),
        ]);

        config()->set('filament.admin_emails', [$this->admin->email]);
    }

    public function test_post_creation_rejects_non_image_files(): void
    {
        Storage::fake('s3');

        $category = Category::create([
            'name' => 'General',
            'slug' => 'general',
            'description' => 'General category',
            'user_id' => $this->admin->id,
        ]);

        $invalidFile = UploadedFile::fake()->create('malicious.php', 10, 'application/x-php');

        $response = $this->actingAs($this->admin)->post(route('admin.post-store'), [
            'name' => 'Test Post',
            'content' => 'Sample content',
            'description' => 'Sample description',
            'category_id' => $category->id,
            'file' => $invalidFile,
        ]);

        $response->assertSessionHasErrors(['file']);
    }

    public function test_post_creation_rejects_oversized_files(): void
    {
        Storage::fake('s3');

        $category = Category::create([
            'name' => 'General',
            'slug' => 'general',
            'description' => 'General category',
            'user_id' => $this->admin->id,
        ]);

        // 5MB file exceeds 4096KB limit
        $oversizedFile = UploadedFile::fake()->image('huge.png')->size(5120);

        $response = $this->actingAs($this->admin)->post(route('admin.post-store'), [
            'name' => 'Test Post',
            'content' => 'Sample content',
            'description' => 'Sample description',
            'category_id' => $category->id,
            'file' => $oversizedFile,
        ]);

        $response->assertSessionHasErrors(['file']);
    }

    public function test_post_creation_accepts_valid_image(): void
    {
        Storage::fake('s3');

        $category = Category::create([
            'name' => 'General',
            'slug' => 'general',
            'description' => 'General category',
            'user_id' => $this->admin->id,
        ]);

        $validFile = UploadedFile::fake()->image('valid.png', 200, 200)->size(500);

        $response = $this->actingAs($this->admin)->post(route('admin.post-store'), [
            'name' => 'Valid Post',
            'content' => 'Valid content',
            'description' => 'Valid description',
            'category_id' => $category->id,
            'file' => $validFile,
        ]);

        $response->assertRedirect(route('admin.posts'));
        $this->assertDatabaseHas('posts', [
            'name' => 'Valid Post',
            'slug' => 'valid-post',
        ]);
    }

    public function test_service_creation_rejects_non_image_files(): void
    {
        $invalidFile = UploadedFile::fake()->create('script.sh', 10, 'application/x-sh');

        $response = $this->actingAs($this->admin)->post(route('admin.service-store'), [
            'title' => 'Test Service',
            'details' => 'Some details',
            'price' => '100',
            'status' => 'active',
            'file' => $invalidFile,
        ]);

        $response->assertSessionHasErrors(['file']);
    }
}
