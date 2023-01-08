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
        ];
        DB::table('page_widget')->insert($pageWidget);
    }
}
