<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\Tab;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('translations')->tabs([
                    Tab::make('English')->schema([
                        TextInput::make('name')->required()->maxLength(255),
                        Textarea::make('description')->required()->maxLength(255)->columnSpanFull(),
                    ]),
                    Tab::make('Українська')->schema([
                        TextInput::make('translations.uk.name')->label('Назва'),
                        Textarea::make('translations.uk.description')->label('Опис')->columnSpanFull(),
                    ]),
                    Tab::make('Polski')->schema([
                        TextInput::make('translations.pl.name')->label('Nazwa'),
                        Textarea::make('translations.pl.description')->label('Opis')->columnSpanFull(),
                    ]),
                ])->columnSpanFull(),
                TextInput::make('slug')
                    ->disabled()
                    ->dehydrated(false),
            ]);
    }
}
