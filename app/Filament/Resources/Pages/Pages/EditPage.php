<?php

namespace App\Filament\Resources\Pages\Pages;

use App\Filament\Resources\Pages\PageResource;
use App\Filament\Support\FillsRawTranslatableFields;
use App\Filament\Support\ViewOnSiteAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPage extends EditRecord
{
    use FillsRawTranslatableFields;

    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewOnSiteAction::make(),
            DeleteAction::make(),
        ];
    }
}
