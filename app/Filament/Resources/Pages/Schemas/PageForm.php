<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('page_category_id')
                    ->relationship('pageCategory', 'name')
                    ->searchable()
                    ->preload(),
                TextInput::make('name')->required()->maxLength(255),
                TextInput::make('meta')->required()->maxLength(255),
                TextInput::make('description')->required()->maxLength(255),
                TextInput::make('keywords'),
                RichEditor::make('content')
                    ->required()
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
