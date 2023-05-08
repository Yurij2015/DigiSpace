<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FooterBottomBarContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $footerBottomBarContent = [
            [
                'company_name' => 'DigiSpace',
                'privacy_policy_title' => 'Privacy Policy',
                'privacy_policy_href' => 'privacy-policy',
                'faq' => 'FAQ',
                'faq_href' => 'faq',
                'support' => 'Support',
                'support_href' => 'support',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        DB::table('footer_bottom_bar_contents')->insert($footerBottomBarContent);
    }
}
