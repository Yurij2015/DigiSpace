<?php

namespace App\Filament\Resources\Widgets\Schemas;

use App\Filament\Support\ContentImage;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class WidgetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('subtitle'),
                Select::make('widget_category_id')
                    ->relationship('widgetCategory', 'name')
                    ->required(),
                TextInput::make('icon'),
                ContentImage::make('widget_image', 's3', 'widgets', true),
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('css_class'),
                TextInput::make('anchor'),
                TextInput::make('element_id'),
            ]);
    }
}
