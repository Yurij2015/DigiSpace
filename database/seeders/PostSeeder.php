<?php

namespace Database\Seeders;

use Database\Seeders\Support\JsonTableSeeder;

/**
 * Rows and their en/uk/pl values live in database/seeders/data/posts.json.
 */
class PostSeeder extends JsonTableSeeder
{
    protected string $table = 'posts';
}
