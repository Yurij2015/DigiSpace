<?php

namespace App\Filament\Resources\Services\Schemas;

use App\Filament\Support\ContentEditor;
use App\Filament\Support\ContentImage;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('translations')
                    ->tabs([
                        Tab::make('English')->schema([
                            TextInput::make('title')->required()->maxLength(255),
                            TextInput::make('details')->maxLength(255),
                            TextInput::make('timeline')->maxLength(255)->helperText('Shown in the price matrix, e.g. "2–4 weeks"'),
                            TextInput::make('image_alt')->maxLength(255),
                            ContentEditor::make('description', 'services/content'),
                            Textarea::make('seo_description')->columnSpanFull(),
                            TextInput::make('seo_title')->maxLength(255),
                            TextInput::make('seo_keywords')->maxLength(255),
                        ]),
                        Tab::make('Українська')->schema([
                            TextInput::make('translations.uk.title')->label('Назва')->maxLength(255),
                            TextInput::make('translations.uk.details')->label('Деталі')->maxLength(255),
                            TextInput::make('translations.uk.timeline')->label('Термін')->maxLength(255),
                            TextInput::make('translations.uk.image_alt')->label('Alt текст')->maxLength(255),
                            ContentEditor::make('translations.uk.description', 'services/content')->label('Опис'),
                            Textarea::make('translations.uk.seo_description')->label('SEO опис')->columnSpanFull(),
                            TextInput::make('translations.uk.seo_title')->label('SEO заголовок')->maxLength(255),
                            TextInput::make('translations.uk.seo_keywords')->label('SEO ключові слова')->maxLength(255),
                        ]),
                        Tab::make('Polski')->schema([
                            TextInput::make('translations.pl.title')->label('Tytuł')->maxLength(255),
                            TextInput::make('translations.pl.details')->label('Szczegóły')->maxLength(255),
                            TextInput::make('translations.pl.timeline')->label('Termin')->maxLength(255),
                            TextInput::make('translations.pl.image_alt')->label('Tekst alt')->maxLength(255),
                            ContentEditor::make('translations.pl.description', 'services/content')->label('Opis'),
                            Textarea::make('translations.pl.seo_description')->label('Opis SEO')->columnSpanFull(),
                            TextInput::make('translations.pl.seo_title')->label('Tytuł SEO')->maxLength(255),
                            TextInput::make('translations.pl.seo_keywords')->label('Słowa kluczowe SEO')->maxLength(255),
                        ]),
                    ])
                    ->columnSpanFull(),
                TextInput::make('price')->numeric()->prefix('$'),
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
                ContentImage::make('image', 's3', 'services'),
                TextInput::make('slug')->disabled()->dehydrated(false),
            ]);
    }
}
