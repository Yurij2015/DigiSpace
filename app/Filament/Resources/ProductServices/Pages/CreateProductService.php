<?php

namespace App\Filament\Resources\ProductServices\Pages;

use App\Filament\Resources\ProductServices\ProductServiceResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductService extends CreateRecord
{
    protected static string $resource = ProductServiceResource::class;
}
