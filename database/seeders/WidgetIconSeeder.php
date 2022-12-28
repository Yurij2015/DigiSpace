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
                'widget_id' => '8',
                'icon_class' => 'fas fa-fingerprint',
                'description' => 'Carefully crafted components',
                'url' => '',
                'css_class' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'widget_id' => '8',
                'icon_class' => 'fab fa-html5',
                'description' => 'Amazing page examples',
                'url' => '',
                'css_class' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'widget_id' => '8',
                'icon_class' => 'far fa-paper-plane',
                'description' => 'Dynamic components',
                'url' => '',
                'css_class' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'widget_id' => '10',
                'icon_class' => 'fab fa-dribbble',
                'description' => '#',
                'url' => '',
                'css_class' => 'bg-pink-500',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'widget_id' => '10',
                'icon_class' => 'fab fa-google',
                'description' => '#',
                'url' => '',
                'css_class' => 'bg-red-600',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'widget_id' => '10',
                'icon_class' => 'fab fa-twitter',
                'description' => '#',
                'url' => '',
                'css_class' => 'bg-lightBlue-400',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'widget_id' => '11',
                'icon_class' => 'fab fa-google',
                'description' => '#',
                'url' => '',
                'css_class' => 'bg-red-600',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'widget_id' => '11',
                'icon_class' => 'fab fa-dribbble',
                'description' => '#',
                'url' => '',
                'css_class' => 'bg-pink-500',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'widget_id' => '11',
                'icon_class' => 'fab fa-twitter',
                'description' => '#',
                'url' => '',
                'css_class' => 'bg-lightBlue-400',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'widget_id' => '11',
                'icon_class' => 'fab fa-instagram',
                'description' => '#',
                'url' => '',
                'css_class' => 'bg-blueGray-700 ',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'widget_id' => '12',
                'icon_class' => 'fab fa-dribbble',
                'description' => '#',
                'url' => '',
                'css_class' => 'bg-pink-500',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'widget_id' => '12',
                'icon_class' => 'fab fa-google',
                'description' => '#',
                'url' => '',
                'css_class' => 'bg-red-600',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'widget_id' => '12',
                'icon_class' => 'fab fa-instagram',
                'description' => '#',
                'url' => '',
                'css_class' => 'bg-blueGray-700',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'widget_id' => '12',
                'icon_class' => 'fab fa-facebook-f',
                'description' => '#',
                'url' => '',
                'css_class' => 'bg-lightBlue-600',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'widget_id' => '12',
                'icon_class' => 'fab fa-twitter',
                'description' => '#',
                'url' => '',
                'css_class' => 'bg-lightBlue-400',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'widget_id' => '13',
                'icon_class' => 'fab fa-dribbble',
                'description' => '#',
                'url' => '',
                'css_class' => 'bg-pink-500',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'widget_id' => '13',
                'icon_class' => 'fab fa-twitter',
                'description' => '#',
                'url' => '',
                'css_class' => 'bg-lightBlue-400',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'widget_id' => '13',
                'icon_class' => 'fab fa-google',
                'description' => '#',
                'url' => '',
                'css_class' => 'bg-red-600',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'widget_id' => '19',
                'icon_class' => 'fab fa-twitter',
                'description' => '#',
                'url' => '',
                'css_class' => 'text-lightBlue-400',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'widget_id' => '19',
                'icon_class' => 'fab fa-facebook-square',
                'description' => '#',
                'url' => '',
                'css_class' => 'text-lightBlue-600',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'widget_id' => '19',
                'icon_class' => 'fab fa-dribbble',
                'description' => '#',
                'url' => '',
                'css_class' => 'text-pink-400',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'widget_id' => '19',
                'icon_class' => 'fab fa-github',
                'description' => '#',
                'url' => '',
                'css_class' => 'text-blueGray-800',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        DB::table('widget_icons')->insert($widgetIcons);
    }
}
