<?php

namespace Database\Seeders;

use Database\Seeders\Support\JsonTableSeeder;

/**
 * Rows and their en/uk/pl values live in database/seeders/data/service_categories.json.
 */
class ServiceCategorySeeder extends JsonTableSeeder
{
    protected string $table = 'service_categories';
}
