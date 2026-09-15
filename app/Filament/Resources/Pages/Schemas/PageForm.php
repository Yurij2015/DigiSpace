<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Filament\Support\ContentEditor;
use App\Filament\Support\SeoFields;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class PageForm
{
    private const ATTACHMENTS = 'pages/content';

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('translations')
                    ->tabs([
                        Tab::make('English')->schema([
                            TextInput::make('name')->required()->maxLength(255),
                            TextInput::make('slug')->disabled()->dehydrated(false)->helperText('Generated from the English name; the public URL uses the linked menu item slug.'),
                            ContentEditor::make('content', self::ATTACHMENTS)->required(),
                            SeoFields::section('description', 'keywords', metaPath: 'meta', required: true),
                        ]),
                        Tab::make('Українська')->schema([
                            TextInput::make('translations.uk.name')->label('Назва')->maxLength(255),
                            ContentEditor::make('translations.uk.content', self::ATTACHMENTS)->label('Контент'),
                            SeoFields::section('translations.uk.description', 'translations.uk.keywords', 'Опис', 'Ключові слова', 'translations.uk.meta', 'Meta'),
                        ]),
                        Tab::make('Polski')->schema([
                            TextInput::make('translations.pl.name')->label('Nazwa')->maxLength(255),
                            ContentEditor::make('translations.pl.content', self::ATTACHMENTS)->label('Treść'),
                            SeoFields::section('translations.pl.description', 'translations.pl.keywords', 'Opis', 'Słowa kluczowe', 'translations.pl.meta', 'Meta'),
                        ]),
                    ])
                    ->columnSpanFull(),
                Section::make('Placement')
                    ->description('Where the page appears on the site and which widgets it shows.')
                    ->columns(2)
                    ->schema([
                        Select::make('page_category_id')
                            ->relationship('pageCategory', 'name')
                            ->searchable()
                            ->preload(),
                        Select::make('menu_item_id')
                            ->relationship('menuItem', 'name')
                            ->searchable()
                            ->preload()
                            ->helperText('The public URL is /pages/{menu item slug}.'),
                        Select::make('widgets')
                            ->relationship('widgets', 'title')
                            ->multiple()
                            ->searchable()
                            ->preload()
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
