<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tab;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([Select::make('widgets')->relationship('widgets', 'title')->multiple()->searchable()->preload()->columnSpanFull(),
                Select::make('page_category_id')
                    ->relationship('pageCategory', 'name')
                    ->searchable()
                    ->preload(),
                Tabs::make('translations')
                    ->tabs([
                        Tab::make('English')->schema([
                            TextInput::make('name')->required()->maxLength(255),
                            TextInput::make('meta')->required()->maxLength(255),
                            TextInput::make('description')->required()->maxLength(255),
                            TextInput::make('keywords'),
                            RichEditor::make('content')->required()->columnSpanFull(),
                        ]),
                        Tab::make('Українська')->schema([
                            TextInput::make('translations.uk.name')->label('Назва')->maxLength(255),
                            TextInput::make('translations.uk.meta')->label('Meta')->maxLength(255),
                            TextInput::make('translations.uk.description')->label('Опис')->maxLength(255),
                            TextInput::make('translations.uk.keywords')->label('Ключові слова'),
                            RichEditor::make('translations.uk.content')->label('Контент')->columnSpanFull(),
                        ]),
                        Tab::make('Polski')->schema([
                            TextInput::make('translations.pl.name')->label('Nazwa')->maxLength(255),
                            TextInput::make('translations.pl.meta')->label('Meta')->maxLength(255),
                            TextInput::make('translations.pl.description')->label('Opis')->maxLength(255),
                            TextInput::make('translations.pl.keywords')->label('Słowa kluczowe'),
                            RichEditor::make('translations.pl.content')->label('Treść')->columnSpanFull(),
                        ]),
                    ])
                    ->columnSpanFull(),
                TextInput::make('slug')
                    ->disabled()
                    ->dehydrated(false)
                    ->columnSpanFull(),
                Select::make('menu_item_id')
                    ->relationship('menuItem', 'name')
                    ->searchable()
                    ->preload(),
            ]);
    }
}
