<?php

namespace App\Filament\Resources\ProductServices\Schemas;

use App\Models\Product;
use App\Models\Service;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('product_id')->options(fn () => Product::pluck('title', 'id'))->searchable()->required(),
                Select::make('service_id')->options(fn () => Service::pluck('title', 'id'))->searchable()->required(),
                TextInput::make('service_css_class'),
                TextInput::make('product_css_class'),
            ]);
    }
}
