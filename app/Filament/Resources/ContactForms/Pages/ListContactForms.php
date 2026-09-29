<?php

namespace App\Filament\Resources\ContactForms\Pages;

use App\Filament\Resources\ContactForms\ContactFormResource;
use Filament\Resources\Pages\ListRecords;

class ListContactForms extends ListRecords
{
    protected static string $resource = ContactFormResource::class;
}
