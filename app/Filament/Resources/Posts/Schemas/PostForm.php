<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Filament\Support\ContentEditor;
use App\Filament\Support\ContentImage;
use App\Filament\Support\SeoFields;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class PostForm
{
    private const ATTACHMENTS = 'posts/content';

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('translations')
                    ->tabs([
                        Tab::make('English')->schema([
                            TextInput::make('name')->required()->maxLength(255),
                            TextInput::make('slug')->disabled()->dehydrated(false)->helperText('Generated from the English name.'),
                            ContentEditor::make('content', self::ATTACHMENTS)->required(),
                            SeoFields::section('description', 'keywords'),
                        ]),
                        Tab::make('Українська')->schema([
                            TextInput::make('translations.uk.name')->label('Назва')->maxLength(255),
                            ContentEditor::make('translations.uk.content', self::ATTACHMENTS)->label('Контент'),
                            SeoFields::section('translations.uk.description', 'translations.uk.keywords', 'Опис', 'Ключові слова'),
                        ]),
                        Tab::make('Polski')->schema([
                            TextInput::make('translations.pl.name')->label('Nazwa')->maxLength(255),
                            ContentEditor::make('translations.pl.content', self::ATTACHMENTS)->label('Treść'),
                            SeoFields::section('translations.pl.description', 'translations.pl.keywords', 'Opis', 'Słowa kluczowe'),
                        ]),
                    ])
                    ->columnSpanFull(),
                Section::make('Publishing')
                    ->columns(2)
                    ->schema([
                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('status')
                            ->options(['draft' => 'Draft', 'published' => 'Published', 'archived' => 'Archived'])
                            ->default('draft')
                            ->required(),
                        ContentImage::make('img_path', 's3', 'posts', true)
                            ->label('Cover image')
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
