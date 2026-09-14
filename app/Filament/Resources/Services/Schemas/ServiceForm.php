<?php

namespace App\Filament\Resources\Services\Schemas;

use App\Filament\Support\ContentImage;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')->required()->maxLength(255),
                TextInput::make('details')->required()->maxLength(255),
                TextInput::make('price')->numeric()->prefix('$')->required(),
                Select::make('service_category_id')
                    ->relationship('serviceCategory', 'name')
                    ->searchable()
                    ->preload(),
                Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                        'pending' => 'Pending',
                        'suspended' => 'Suspended',
                    ])
                    ->default('inactive')
                    ->required(),
                TextInput::make('image_alt')->maxLength(255),
                ContentImage::make('image', 'service_images'),
                Textarea::make('description')->columnSpanFull(),
                Textarea::make('seo_description')->columnSpanFull(),
                TextInput::make('seo_title')->maxLength(255),
                TextInput::make('seo_keywords')->maxLength(255),
                TextInput::make('slug')->disabled()->dehydrated(false),
            ]);
    }
}
