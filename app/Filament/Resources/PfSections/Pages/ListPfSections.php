<?php

namespace App\Filament\Resources\PfSections\Pages;

use App\Filament\Resources\PfSections\PfSectionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPfSections extends ListRecords
{
    protected static string $resource = PfSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
