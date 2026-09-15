<?php

namespace Database\Seeders;

use Database\Seeders\Support\JsonTableSeeder;

/**
 * Rows and their en/uk/pl values live in database/seeders/data/pages.json.
 */
class PageSeeder extends JsonTableSeeder
{
    protected string $table = 'pages';
}
