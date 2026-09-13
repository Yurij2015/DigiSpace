<?php

namespace App\Filament\Resources\Widgets\Schemas;

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
                TextInput::make('widget_image')
                    ->label('Image path or URL'),
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('css_class'),
                TextInput::make('anchor'),
                TextInput::make('element_id'),
            ]);
    }
}
