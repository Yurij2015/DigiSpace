<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use App\Filament\Support\FillsRawTranslatableFields;
use App\Filament\Support\ViewOnSiteAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

class EditPost extends EditRecord
{
    use FillsRawTranslatableFields;

    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewOnSiteAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['slug'] = Str::slug($data['name']);

        return $data;
    }
}
