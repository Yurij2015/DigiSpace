<?php

namespace App\Filament\Support;

use Filament\Forms\Components\RichEditor;

/**
 * The one content editor for posts, pages (and later widgets): a full toolbar and image
 * uploads straight to MinIO, embedded as absolute URLs like every other site image.
 */
class ContentEditor
{
    public const DISK = 's3';

    public const MAX_IMAGE_KB = 2048;

    /** @var list<string> */
    public const IMAGE_TYPES = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

    /** @var list<list<string>> */
    public const TOOLBAR = [
        ['h2', 'h3', 'h4'],
        ['bold', 'italic', 'underline', 'strike'],
        ['bulletList', 'orderedList', 'blockquote', 'codeBlock'],
        ['link', 'attachFiles', 'table', 'horizontalRule'],
        ['alignStart', 'alignCenter', 'alignEnd', 'alignJustify'],
        ['undo', 'redo'],
    ];

    /**
     * @param  string  $attachmentsDirectory  e.g. "posts/content" — where inserted images land on the disk
     */
    public static function make(string $name, string $attachmentsDirectory): RichEditor
    {
        return RichEditor::make($name)
            ->toolbarButtons(self::TOOLBAR)
            ->fileAttachmentsDisk(self::DISK)
            ->fileAttachmentsDirectory($attachmentsDirectory)
            ->fileAttachmentsVisibility('public')
            ->fileAttachmentsAcceptedFileTypes(self::IMAGE_TYPES)
            ->fileAttachmentsMaxSize(self::MAX_IMAGE_KB)
            ->columnSpanFull();
    }
}
