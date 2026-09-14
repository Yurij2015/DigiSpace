<?php

namespace App\Filament\Resources\ServiceCategories\Schemas;

use Filament\Forms\Components\Tab;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ServiceCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('translations')->tabs([
                    Tab::make('English')->schema([
                        TextInput::make('name')->required(),
                        TextInput::make('seo_keywords'),
                        TextInput::make('seo_description'),
                        TextInput::make('seo_title'),
                    ]),
                    Tab::make('Українська')->schema([
                        TextInput::make('translations.uk.name')->label('Назва'),
                        TextInput::make('translations.uk.seo_keywords')->label('SEO ключові слова'),
                        TextInput::make('translations.uk.seo_description')->label('SEO опис'),
                        TextInput::make('translations.uk.seo_title')->label('SEO заголовок'),
                    ]),
                    Tab::make('Polski')->schema([
                        TextInput::make('translations.pl.name')->label('Nazwa'),
                        TextInput::make('translations.pl.seo_keywords')->label('Słowa kluczowe SEO'),
                        TextInput::make('translations.pl.seo_description')->label('Opis SEO'),
                        TextInput::make('translations.pl.seo_title')->label('Tytuł SEO'),
                    ]),
                ])->columnSpanFull(),
                TextInput::make('slug'),
            ]);
    }
}
