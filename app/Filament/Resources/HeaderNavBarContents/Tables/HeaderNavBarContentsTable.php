<?php

namespace App\Filament\Resources\HeaderNavBarContents\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HeaderNavBarContentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('first_col_name')
                    ->searchable(),
                TextColumn::make('first_col_href')
                    ->searchable(),
                TextColumn::make('first_col_href_content')
                    ->searchable(),
                TextColumn::make('second_col_name')
                    ->searchable(),
                TextColumn::make('second_col_href')
                    ->searchable(),
                TextColumn::make('second_col_href_content')
                    ->searchable(),
                TextColumn::make('first_soc_button_style')
                    ->searchable(),
                TextColumn::make('first_soc_button_href')
                    ->searchable(),
                TextColumn::make('second_soc_button_style')
                    ->searchable(),
                TextColumn::make('second_soc_button_href')
                    ->searchable(),
                TextColumn::make('third_soc_button_style')
                    ->searchable(),
                TextColumn::make('third_soc_button_href')
                    ->searchable(),
                TextColumn::make('fourth_soc_button_style')
                    ->searchable(),
                TextColumn::make('fourth_soc_button_href')
                    ->searchable(),
                IconColumn::make('login_button_status')
                    ->boolean(),
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
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
