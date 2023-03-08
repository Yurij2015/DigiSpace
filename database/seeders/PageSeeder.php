<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    public function run()
    {
        $pages = [
            [
                'name' => null,
                'page_category_id' => null,
                'meta' => null,
                'description' => null,
                'content' => null,
                'slug' => 'about',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => null,
                'page_category_id' => null,
                'meta' => null,
                'description' => null,
                'content' => null,
                'slug' => 'services',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Our prices',
                'page_category_id' => null,
                'meta' => null,
                'description' => 'Prices of our services',
                'content' => null,
                'slug' => 'pricing',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Promos',
                'page_category_id' => null,
                'meta' => null,
                'description' => 'Promos of our company',
                'content' => null,
                'slug' => 'promos',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Contact Us',
                'page_category_id' => null,
                'meta' => null,
                'description' => 'Contact Us',
                'content' => null,
                'slug' => 'contact-us',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        DB::table('pages')->insert($pages);
    }
}
