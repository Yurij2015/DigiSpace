<?php

namespace Tests\Feature\Filament;

use App\Filament\Resources\Pages\Pages\CreatePage;
use App\Filament\Resources\Posts\Pages\CreatePost;
use App\Filament\Support\ContentEditor;
use Filament\Forms\Components\RichEditor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\FileUploadConfiguration;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Livewire;
use Tests\TestCase;

class ContentEditorTest extends TestCase
{
    use MakesFilamentAdmin;
    use RefreshDatabase;

    /** @return array<string, RichEditor> state path → editor component of a create page */
    private function editorsOf(string $pageClass): array
    {
        $this->actingAsFilamentAdmin();
        $page = Livewire::test($pageClass)->instance();
        $editors = [];

        foreach ($page->getSchema('form')->getFlatComponents(withHidden: true) as $component) {
            if ($component instanceof RichEditor) {
                $editors[$component->getStatePath(isAbsolute: false)] = $component;
            }
        }

        return $editors;
    }

    public function test_post_and_page_forms_use_the_shared_editor_in_every_language_tab(): void
    {
        foreach ([CreatePost::class => 'posts/content', CreatePage::class => 'pages/content'] as $pageClass => $directory) {
            $editors = $this->editorsOf($pageClass);

            self::assertSame(['content', 'translations.uk.content', 'translations.pl.content'], array_keys($editors), $pageClass);

            foreach ($editors as $path => $editor) {
                self::assertSame('s3', $editor->getFileAttachmentsDiskName(), "$pageClass $path disk");
                self::assertSame($directory, $editor->getFileAttachmentsDirectory(), "$pageClass $path directory");
                self::assertSame('public', $editor->getFileAttachmentsVisibility(), "$pageClass $path visibility");
                self::assertSame(ContentEditor::MAX_IMAGE_KB, $editor->getFileAttachmentsMaxSize(), "$pageClass $path max size");
                foreach (['h2', 'h3', 'bulletList', 'link', 'attachFiles', 'table', 'alignCenter', 'horizontalRule', 'undo'] as $tool) {
                    self::assertTrue($editor->hasToolbarButton($tool), "$pageClass $path lacks $tool");
                }
            }
        }
    }

    public function test_an_inserted_image_is_stored_on_object_storage_under_the_content_directory(): void
    {
        Storage::fake('s3');
        $editor = $this->editorsOf(CreatePost::class)['content'];

        $temporary = $this->temporaryUpload(UploadedFile::fake()->image('photo.png', 400, 300)->size(100));

        $path = $editor->saveUploadedFileAttachment($temporary);

        self::assertIsString($path);
        self::assertStringStartsWith('posts/content/', $path);
        Storage::disk('s3')->assertExists($path);
    }

    public function test_an_oversized_image_is_rejected(): void
    {
        Storage::fake('s3');
        $editor = $this->editorsOf(CreatePost::class)['content'];
        // ->size() on a fake image only reports a size; write real bytes so the max:2048 rule sees 5 MB.
        $temporary = $this->temporaryUpload(UploadedFile::fake()->create('big.png', 5 * 1024, 'image/png'));

        self::assertNull($editor->getUploadedFileAttachment($temporary));
    }

    /** Mimics what Livewire holds after a browser upload: the file sits on the temporary-upload disk. */
    private function temporaryUpload(UploadedFile $upload): TemporaryUploadedFile
    {
        // Livewire uses the "tmp-for-tests" disk under PHPUnit; back it with a fake local disk.
        $disk = FileUploadConfiguration::disk();
        Storage::fake($disk);
        $path = $upload->store(FileUploadConfiguration::directory(), $disk);

        return new TemporaryUploadedFile(basename($path), $disk);
    }
}
