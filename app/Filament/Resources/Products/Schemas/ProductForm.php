<?php

namespace App\Filament\Resources\Products\Schemas;

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
                TextInput::make('product_code'),
                TextInput::make('product_name'),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('position')
                    ->numeric(),
                Toggle::make('is_prefered')
                    ->required(),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('title'),
                TextInput::make('price_value')
                    ->numeric(),
                TextInput::make('details'),
            ]);
    }
}
