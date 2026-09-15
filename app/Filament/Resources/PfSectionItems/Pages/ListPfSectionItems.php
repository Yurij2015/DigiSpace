<?php

namespace App\Filament\Resources\PfSectionItems\Pages;

use App\Filament\Resources\PfSectionItems\PfSectionItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPfSectionItems extends ListRecords
{
    protected static string $resource = PfSectionItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
