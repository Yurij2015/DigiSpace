<?php

namespace App\Filament\Resources\PfPlaces\Pages;

use App\Filament\Resources\PfPlaces\PfPlaceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPfPlaces extends ListRecords
{
    protected static string $resource = PfPlaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
