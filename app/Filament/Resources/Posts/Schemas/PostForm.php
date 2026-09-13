<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
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
                TextInput::make('name')->required()->maxLength(255),
                TextInput::make('slug')->disabled()->dehydrated(false),
                RichEditor::make('content')
                    ->required()
                    ->columnSpanFull(),
                Select::make('status')
                    ->options(['draft' => 'Draft', 'published' => 'Published', 'archived' => 'Archived'])
                    ->default('draft'),
                TextInput::make('description')->maxLength(255),
                TextInput::make('keywords'),
                TextInput::make('img_path'),
            ]);
    }
}
