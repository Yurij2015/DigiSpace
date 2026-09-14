<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tab;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('translations')->tabs([
                    Tab::make('English')->schema([
                        TextInput::make('title')->required()->maxLength(255),
                        TextInput::make('product_name')->maxLength(255),
                        TextInput::make('details')->maxLength(255),
                        Textarea::make('description')->columnSpanFull(),
                    ]),
                    Tab::make('Українська')->schema([
                        TextInput::make('translations.uk.title')->label('Назва'),
                        TextInput::make('translations.uk.product_name')->label('Назва продукту'),
                        TextInput::make('translations.uk.details')->label('Деталі'),
                        Textarea::make('translations.uk.description')->label('Опис')->columnSpanFull(),
                    ]),
                    Tab::make('Polski')->schema([
                        TextInput::make('translations.pl.title')->label('Tytuł'),
                        TextInput::make('translations.pl.product_name')->label('Nazwa produktu'),
                        TextInput::make('translations.pl.details')->label('Szczegóły'),
                        Textarea::make('translations.pl.description')->label('Opis')->columnSpanFull(),
                    ]),
                ])->columnSpanFull(),
                TextInput::make('product_code')->maxLength(255),
                TextInput::make('price_value')->numeric()->prefix('$'),
                Select::make('services')
                    ->relationship('services', 'title')
                    ->multiple()
                    ->searchable()
                    ->preload()
                    ->columnSpanFull(),
                TextInput::make('position')->numeric(),
                Toggle::make('is_prefered')->label('Preferred'),
                Toggle::make('is_active')->default(true)->required(),
            ]);
    }
}
