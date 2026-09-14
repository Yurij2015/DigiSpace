<?php

namespace App\Filament\Resources\PfSkills\Pages;

use App\Filament\Resources\PfSkills\PfSkillsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPfSkills extends ListRecords
{
    protected static string $resource = PfSkillsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
