<?php

namespace App\Filament\Resources\FooterBottomBarContents\Pages;

use App\Filament\Resources\FooterBottomBarContents\FooterBottomBarContentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFooterBottomBarContents extends ListRecords
{
    protected static string $resource = FooterBottomBarContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
