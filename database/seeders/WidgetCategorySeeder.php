<?php

namespace Database\Seeders;

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
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Landing.  Midle block',
                'title' => 'Landing.  Midle block',
                'description' => 'Widget of middle of landing',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Landing. Body Top',
                'title' => 'Landing. Body Top',
                'description' => 'Widget of body top',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Landing. Body Middle',
                'title' => 'Landing. Body Middle',
                'description' => 'Widget of body middle',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Landing. Body Bottom',
                'title' => 'Landing. Body Bottom',
                'description' => 'Widget of body bottom',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Landing. Footer',
                'title' => 'Landing. Footer',
                'description' => 'Widget of footer',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'DigiSpace | About | General Info',
                'title' => 'DigiSpace | About | General Info',
                'description' => 'Widgets of the about page | General info',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'DigiSpace | About | Team',
                'title' => 'DigiSpace | About | Team',
                'description' => 'Meet Our Team',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Some Facts About Us',
                'title' => 'DigiSpace | Some Facts About Us',
                'description' => 'More than 1000 apps developed',
                'image' => 'images/bg-about-page-some-facts.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Our Clients',
                'title' => 'DigiSpace | Our Clients',
                'description' => 'Our Clients',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Footer',
                'title' => 'DigiSpace | Footer',
                'description' => 'Footer',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Why Choose Us',
                'title' => 'DigiSpace | Why Choose Us',
                'description' => 'Why Choose Us',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Frequently Asked Questions',
                'title' => 'DigiSpace | Question-Answer',
                'description' => 'Question-Answer block',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Promos',
                'title' => 'DigiSpace | Promos',
                'description' => 'Promos widgets',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Get in Touch',
                'title' => 'DigiSpace | Get in Touch',
                'description' => 'Get in Touch widgets',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('widget_categories')->insert($widgetCategories);
    }
}
