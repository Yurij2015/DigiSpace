<?php

namespace App\Filament\Resources\Pages\Tables;

use App\Models\Page;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Page name')
                    ->formatStateUsing(fn (?string $state, Page $record): string => $state ?: $record->slug)
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable()
                    ->copyable(),
                TextColumn::make('pageCategory.name')
                    ->label('Page category')
                    ->placeholder('—')
                    ->searchable(),
                TextColumn::make('menuItem.name')
                    ->label('Menu item')
                    ->placeholder('—')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([]);
    }
}
