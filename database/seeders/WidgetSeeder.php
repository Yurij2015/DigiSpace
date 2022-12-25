<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WidgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $widgets = [
            [
                'title' => 'Your story starts with us.',
                'subtitle' => 'Your story starts with us.',
                'widget_category_id' => 1,
                'icon' => '',
                'widget_image' => '',
                'content' => 'This is a simple example of a Landing Page you can build using Vue Notus. It features multiple CSS components based on the Tailwind CSS design system.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Awarded Agency',
                'subtitle' => 'Awarded Agency',
                'widget_category_id' => 2,
                'icon' => 'fas fa-award',
                'widget_image' => '',
                'content' => 'Divide details about your product or agency work into parts. A paragraph describing a feature will be enough.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Free Revisions',
                'subtitle' => 'Free Revisions',
                'widget_category_id' => 2,
                'icon' => 'fas fa-retweet',
                'widget_image' => '',
                'content' => 'Keep you user engaged by providing meaningful information. Remember that by this time, the user is curious.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Verified Company',
                'subtitle' => 'Verified Company',
                'widget_category_id' => 2,
                'icon' => 'fas fa-fingerprint',
                'widget_image' => '',
                'content' => 'Write a few lines about each one. A paragraph describing a feature will be enough. Keep you user engaged!',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        DB::table('widgets')->insert($widgets);
    }
}
