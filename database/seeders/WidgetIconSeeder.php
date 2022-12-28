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
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'widget_id' => '8',
                'icon_class' => 'fab fa-html5',
                'description' => 'Amazing page examples',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'widget_id' => '8',
                'icon_class' => 'far fa-paper-plane',
                'description' => '#',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'widget_id' => '10',
                'icon_class' => 'fab fa-dribbble',
                'description' => '#',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'widget_id' => '10',
                'icon_class' => 'fab fa-google',
                'description' => '#',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'widget_id' => '10',
                'icon_class' => 'fab fa-twitter',
                'description' => '#',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'widget_id' => '11',
                'icon_class' => 'fab fa-google',
                'description' => '#',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'widget_id' => '11',
                'icon_class' => 'fab fa-dribbble',
                'description' => '#',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'widget_id' => '11',
                'icon_class' => 'fab fa-twitter',
                'description' => '#',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'widget_id' => '11',
                'icon_class' => 'far fa-paper-plane',
                'description' => '#',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'widget_id' => '12',
                'icon_class' => 'fab fa-dribbble',
                'description' => '#',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'widget_id' => '12',
                'icon_class' => 'fab fa-google',
                'description' => '#',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'widget_id' => '12',
                'icon_class' => 'fab fa-instagram',
                'description' => '#',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'widget_id' => '12',
                'icon_class' => 'fab fa-facebook-f',
                'description' => '#',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'widget_id' => '12',
                'icon_class' => 'fab fa-twitter',
                'description' => '#',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'widget_id' => '13',
                'icon_class' => 'fab fa-dribbble',
                'description' => '#',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'widget_id' => '13',
                'icon_class' => 'fab fa-twitter',
                'description' => '#',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'widget_id' => '13',
                'icon_class' => 'fab fa-google',
                'description' => '#',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        DB::table('widget_icons')->insert($widgetIcons);
    }
}
