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
                'name' => 'Landing. Header block',
                'title' => 'Landing. Header block',
                'description' => 'Widget of top of landing',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Landing.  Midle block',
                'title' => 'Landing.  Midle block',
                'description' => 'Widget of middle of landing',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Landing. Body Top',
                'title' => 'Landing. Body Top',
                'description' => 'Widget of body top',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Landing. Body Middle',
                'title' => 'Landing. Body Middle',
                'description' => 'Widget of body middle',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Landing. Body Bottom',
                'title' => 'Landing. Body Bottom',
                'description' => 'Widget of body bottom',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Landing. Footer',
                'title' => 'Landing. Footer',
                'description' => 'Widget of footer',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'DigiSpace | About | General Info',
                'title' => 'DigiSpace | About | General Info',
                'description' => 'Widgets of the about page | General info',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'DigiSpace | About | Team',
                'title' => 'DigiSpace | About | Team',
                'description' => 'Meet Our Team',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'DigiSpace | Some Facts About Us',
                'title' => 'Some Facts About Us',
                'description' => 'More than 1000 apps developed',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        DB::table('widget_categories')->insert($widgetCategories);
    }
}
