<?php

namespace App\Filament\Resources\PfEducationItems\Pages;

use App\Filament\Resources\PfEducationItems\PfEducationItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPfEducationItems extends ListRecords
{
    protected static string $resource = PfEducationItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
