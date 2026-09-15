<?php

namespace App\Filament\Resources\PfSkillTypes\Pages;

use App\Filament\Resources\PfSkillTypes\PfSkillTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPfSkillTypes extends ListRecords
{
    protected static string $resource = PfSkillTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
