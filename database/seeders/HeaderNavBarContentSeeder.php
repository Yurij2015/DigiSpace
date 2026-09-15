<?php

namespace Database\Seeders;

use Database\Seeders\Support\JsonTableSeeder;

/**
 * Rows and their en/uk/pl values live in database/seeders/data/header_nav_bar_contents.json.
 */
class HeaderNavBarContentSeeder extends JsonTableSeeder
{
    protected string $table = 'header_nav_bar_contents';
}
