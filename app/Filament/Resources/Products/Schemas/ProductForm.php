<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\Select;
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
                TextInput::make('title')->required()->maxLength(255),
                TextInput::make('product_name')->maxLength(255),
                TextInput::make('product_code')->maxLength(255),
                TextInput::make('price_value')->numeric()->prefix('$'),
                TextInput::make('details')->maxLength(255),
                Textarea::make('description')->columnSpanFull(),
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
