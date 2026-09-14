<?php

namespace App\Filament\Resources\PfSections\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PfSectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([Repeater::make('locales')->label('Translations')->relationship()->maxItems(1)->schema([Section::make('EN')->relationship('en')->schema([
                Hidden::make('lang_code')->default('en'), TextInput::make('title'), Textarea::make('description'), TagsInput::make('tags'),
            ]), Section::make('UA')->relationship('ua')->schema([
                Hidden::make('lang_code')->default('ua'), TextInput::make('title'), Textarea::make('description'), TagsInput::make('tags'),
            ]), Section::make('PL')->relationship('pl')->schema([
                Hidden::make('lang_code')->default('pl'), TextInput::make('title'), Textarea::make('description'), TagsInput::make('tags'),
            ])])->columnSpanFull(),
                TextInput::make('name'),
                TextInput::make('description'),
                TextInput::make('slug'),
            ]);
    }
}
