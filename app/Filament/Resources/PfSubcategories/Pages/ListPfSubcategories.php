<?php

namespace App\Filament\Resources\PfSubcategories\Pages;

use App\Filament\Resources\PfSubcategories\PfSubcategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPfSubcategories extends ListRecords
{
    protected static string $resource = PfSubcategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
