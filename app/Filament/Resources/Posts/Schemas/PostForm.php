<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Filament\Support\ContentImage;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tab;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Tabs::make('translations')
                    ->tabs([
                        Tab::make('English')->schema([
                            TextInput::make('name')->required()->maxLength(255),
                            RichEditor::make('content')->required()->columnSpanFull(),
                            TextInput::make('description')->maxLength(255),
                            TextInput::make('keywords'),
                        ]),
                        Tab::make('Українська')->schema([
                            TextInput::make('translations.uk.name')->label('Назва')->maxLength(255),
                            RichEditor::make('translations.uk.content')->label('Контент')->columnSpanFull(),
                            TextInput::make('translations.uk.description')->label('Опис')->maxLength(255),
                            TextInput::make('translations.uk.keywords')->label('Ключові слова'),
                        ]),
                        Tab::make('Polski')->schema([
                            TextInput::make('translations.pl.name')->label('Nazwa')->maxLength(255),
                            RichEditor::make('translations.pl.content')->label('Treść')->columnSpanFull(),
                            TextInput::make('translations.pl.description')->label('Opis')->maxLength(255),
                            TextInput::make('translations.pl.keywords')->label('Słowa kluczowe'),
                        ]),
                    ])
                    ->columnSpanFull(),
                TextInput::make('slug')->disabled()->dehydrated(false),
                Select::make('status')
                    ->options(['draft' => 'Draft', 'published' => 'Published', 'archived' => 'Archived'])
                    ->default('draft'),
                ContentImage::make('img_path', 's3', 'posts', true),
            ]);
    }
}
