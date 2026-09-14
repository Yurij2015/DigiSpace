<?php

namespace App\Filament\Resources\PfSkillLocales\Pages;

use App\Filament\Resources\PfSkillLocales\PfSkillLocaleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPfSkillLocales extends ListRecords
{
    protected static string $resource = PfSkillLocaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
