<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HeaderNavBarContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $headerNavBarContent = [
            [
                'first_col_name' => 'Contact us',
                'first_col_href' => 'contact-us',
                'first_col_href_content' => '@globaldigispace',
                'second_col_name' => 'E-mail',
                'second_col_href' => 'mailto:admin@globaldigispace.com',
                'second_col_href_content' => 'admin@globaldigispace.com',
                'first_soc_button_style' => 'fa-facebook',
                'first_soc_button_href' => 'facebook.com/digispacecompany',
                'second_soc_button_style' => 'fa-twitter',
                'second_soc_button_href' => 'twitter.com/globaldigispace',
                'third_soc_button_style' => 'fa-telegram',
                'third_soc_button_href' => 't.me/digispacecompany',
                'fourth_soc_button_style' => 'fa-linkedin',
                'fourth_soc_button_href' => 'linkedin.com/groups/12675620',
                'login_button_status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('header_nav_bar_contents')->insert($headerNavBarContent);
    }
}
