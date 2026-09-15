<?php

namespace App\Filament\Support;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

/**
 * The SEO/meta block shown under the content editor in every language tab.
 */
class SeoFields
{
    public const DESCRIPTION_LIMIT = 255;

    public static function section(
        string $descriptionPath,
        string $keywordsPath,
        string $descriptionLabel = 'Description',
        string $keywordsLabel = 'Keywords',
        ?string $metaPath = null,
        string $metaLabel = 'Meta',
        bool $required = false,
    ): Section {
        $fields = [
            Textarea::make($descriptionPath)
                ->label($descriptionLabel)
                ->rows(3)
                ->maxLength(self::DESCRIPTION_LIMIT)
                ->required($required)
                ->helperText('Shown in search results and social previews; up to '.self::DESCRIPTION_LIMIT.' characters.')
                ->columnSpanFull(),
            TextInput::make($keywordsPath)->label($keywordsLabel)->maxLength(255),
        ];

        if ($metaPath !== null) {
            $fields[] = TextInput::make($metaPath)->label($metaLabel)->maxLength(255)->required($required);
        }

        return Section::make('SEO')
            ->columns(2)
            ->collapsible()
            ->schema($fields)
            ->columnSpanFull();
    }
}
