<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WidgetIconSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $widgetIcons = [
            [
                'widget_id' => '23',
                'icon_class' => 'fa fa-facebook',
                'description' => '#',
                'url' => '',
                'css_class' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'widget_id' => '23',
                'icon_class' => 'fa fa-twitter',
                'description' => '#',
                'url' => '',
                'css_class' => 'text-blueGray-800',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'widget_id' => '23',
                'icon_class' => 'fa fa-google-plus',
                'description' => '#',
                'url' => '',
                'css_class' => 'text-blueGray-800',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'widget_id' => '23',
                'icon_class' => 'fab fa-github',
                'description' => '#',
                'url' => '',
                'css_class' => 'fa fa-pinterest-p',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'widget_id' => '24',
                'icon_class' => 'fa fa-facebook',
                'description' => '#',
                'url' => '',
                'css_class' => 'text-blueGray-800',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'widget_id' => '24',
                'icon_class' => 'fa fa-twitter',
                'description' => '#',
                'url' => '',
                'css_class' => 'text-blueGray-800',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'widget_id' => '24',
                'icon_class' => 'fa fa-google-plus',
                'description' => '#',
                'url' => '',
                'css_class' => 'text-blueGray-800',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'widget_id' => '24',
                'icon_class' => 'fa fa-pinterest-p',
                'description' => '#',
                'url' => '',
                'css_class' => 'text-blueGray-800',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'widget_id' => '25',
                'icon_class' => 'fa fa-facebook',
                'description' => '#',
                'url' => '',
                'css_class' => 'text-blueGray-800',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'widget_id' => '25',
                'icon_class' => 'fa fa-twitter',
                'description' => '#',
                'url' => '',
                'css_class' => 'text-blueGray-800',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'widget_id' => '25',
                'icon_class' => 'fa fa-google-plus',
                'description' => '#',
                'url' => '',
                'css_class' => 'text-blueGray-800',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'widget_id' => '25',
                'icon_class' => 'fa fa-pinterest-p',
                'description' => '#',
                'url' => '',
                'css_class' => 'text-blueGray-800',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'widget_id' => '34',
                'icon_class' => 'fa fa-facebook',
                'description' => '#',
                'url' => '',
                'css_class' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'widget_id' => '34',
                'icon_class' => 'fa fa-twitter',
                'description' => '#',
                'url' => '',
                'css_class' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'widget_id' => '34',
                'icon_class' => 'fa fa-google-plus',
                'description' => '#',
                'url' => '',
                'css_class' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'widget_id' => '34',
                'icon_class' => 'fa fa-instagram',
                'description' => '#',
                'url' => '',
                'css_class' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('widget_icons')->insert($widgetIcons);
    }
}
