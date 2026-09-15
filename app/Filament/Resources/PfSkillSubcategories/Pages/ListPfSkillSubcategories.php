<?php

namespace App\Filament\Resources\PfSkillSubcategories\Pages;

use App\Filament\Resources\PfSkillSubcategories\PfSkillSubcategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPfSkillSubcategories extends ListRecords
{
    protected static string $resource = PfSkillSubcategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
