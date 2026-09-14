<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('product_code')->searchable(),
                TextColumn::make('price_value')->money()->sortable(),
                TextColumn::make('services_count')->counts('services')->label('Services')->sortable(),
                IconColumn::make('is_prefered')->boolean()->label('Preferred'),
                IconColumn::make('is_active')->boolean()->label('Active'),
                TextColumn::make('position')->sortable(),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([]);
    }
}
