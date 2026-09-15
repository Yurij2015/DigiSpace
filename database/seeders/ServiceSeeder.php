<?php

namespace Database\Seeders;

use Database\Seeders\Support\JsonTableSeeder;

/**
 * Rows and their en/uk/pl values live in database/seeders/data/services.json.
 */
class ServiceSeeder extends JsonTableSeeder
{
    protected string $table = 'services';
}
