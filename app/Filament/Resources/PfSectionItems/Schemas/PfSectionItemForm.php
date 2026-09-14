<?php

namespace App\Filament\Resources\PfSectionItems\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PfSectionItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([Repeater::make('links')->relationship()->schema([TextInput::make('fa_icon'), TextInput::make('href')->required()])->columnSpanFull(), Repeater::make('locales')->label('Translations')->relationship()->maxItems(1)->schema([Section::make('EN')->relationship('en')->schema([
                Hidden::make('lang_code')->default('en'), TextInput::make('title'), Textarea::make('description'), TagsInput::make('tags'),
            ]), Section::make('UA')->relationship('ua')->schema([
                Hidden::make('lang_code')->default('ua'), TextInput::make('title'), Textarea::make('description'), TagsInput::make('tags'),
            ]), Section::make('PL')->relationship('pl')->schema([
                Hidden::make('lang_code')->default('pl'), TextInput::make('title'), Textarea::make('description'), TagsInput::make('tags'),
            ])])->columnSpanFull(),
                Select::make('section_id')
                    ->relationship('section', 'name'),
                Select::make('subcategory_id')
                    ->relationship('subcategory', 'name'),
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug'),
                TextInput::make('title'),
                Select::make('place_id')
                    ->relationship('place', 'name'),
                KeyValue::make('period'),
                TextInput::make('image_icon_url')->url(),
                TextInput::make('fa_icon'),
                TextInput::make('value'),
                TextInput::make('logo_url')
                    ->url(),
                TextInput::make('href'),
            ]);
    }
}
