<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WidgetCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $widgetCategories = [
            [
                'title' => 'Landing. Header block',
                'description' => 'Widget of top of landing',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Landing.  Midle block',
                'description' => 'Widget of middle of landing',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Landing. Body Top',
                'description' => 'Widget of body top',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Landing. Body Middle',
                'description' => 'Widget of body middle',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Landing. Body Bottom',
                'description' => 'Widget of body bottom',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Landing. Footer',
                'description' => 'Widget of footer',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        DB::table('widget_categories')->insert($widgetCategories);
    }
}
