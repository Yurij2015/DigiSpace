<?php

namespace App\Filament\Resources\HeaderNavBarContents\Pages;

use App\Filament\Resources\HeaderNavBarContents\HeaderNavBarContentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHeaderNavBarContents extends ListRecords
{
    protected static string $resource = HeaderNavBarContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
