<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageWidgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $pageWidget = [
            [
                'page_id' => 1,
                'widget_id' => 20,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'page_id' => 1,
                'widget_id' => 21,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'page_id' => 1,
                'widget_id' => 22,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'page_id' => 1,
                'widget_id' => 23,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'page_id' => 1,
                'widget_id' => 24,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'page_id' => 1,
                'widget_id' => 25,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'page_id' => 1,
                'widget_id' => 26,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'page_id' => 1,
                'widget_id' => 27,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'page_id' => 1,
                'widget_id' => 28,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'page_id' => 1,
                'widget_id' => 29,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'page_id' => 1,
                'widget_id' => 30,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'page_id' => 1,
                'widget_id' => 31,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'page_id' => 2,
                'widget_id' => 37,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'page_id' => 2,
                'widget_id' => 38,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'page_id' => 2,
                'widget_id' => 39,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'page_id' => 2,
                'widget_id' => 40,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'page_id' => 2,
                'widget_id' => 41,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'page_id' => 2,
                'widget_id' => 42,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'page_id' => 2,
                'widget_id' => 43,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'page_id' => 2,
                'widget_id' => 44,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'page_id' => 2,
                'widget_id' => 45,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'page_id' => 2,
                'widget_id' => 46,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'page_id' => 2,
                'widget_id' => 47,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'page_id' => 2,
                'widget_id' => 48,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'page_id' => 4,
                'widget_id' => 49,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'page_id' => 4,
                'widget_id' => 50,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'page_id' => 4,
                'widget_id' => 51,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'page_id' => 5,
                'widget_id' => 52,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        DB::table('page_widget')->insert($pageWidget);
    }
}
