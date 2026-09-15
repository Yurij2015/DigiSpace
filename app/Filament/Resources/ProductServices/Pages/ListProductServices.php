<?php

namespace App\Filament\Resources\ProductServices\Pages;

use App\Filament\Resources\ProductServices\ProductServiceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProductServices extends ListRecords
{
    protected static string $resource = ProductServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
