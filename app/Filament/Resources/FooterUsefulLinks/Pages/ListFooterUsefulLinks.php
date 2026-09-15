<?php

namespace App\Filament\Resources\FooterUsefulLinks\Pages;

use App\Filament\Resources\FooterUsefulLinks\FooterUsefulLinkResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFooterUsefulLinks extends ListRecords
{
    protected static string $resource = FooterUsefulLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
