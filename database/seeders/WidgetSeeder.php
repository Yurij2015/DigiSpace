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
            [
                "title" => "Working with us is a pleasure",
                "subtitle" => "Check free DigiSpace CMS!",
                "widget_category_id" => 3,
                "icon" => "fas fa-user-friends",
                "widget_image" => null,
                "content" => "<p class='text-lg font-light leading-relaxed mt-4 mb-4 text-blueGray-600'>Don't let your uses guess by attaching tooltips and popoves to any element. Just make sure you enable them first via JavaScript. </p><p class='text-lg font-light leading-relaxed mt-0 mb-4 text-blueGray-600'>The kit comes with three pre-built pages to help you get started faster. You can change the text and images and you're good to go. Just make sure you enable them first via JavaScript.</p>",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "title" => "Top Notch Services",
                "subtitle" => "Top Notch Services",
                "widget_category_id" => 3,
                "icon" => null,
                "widget_image" => "1671983508.avif",
                "content" => "The Arctic Ocean freezes every winter and much of the sea-ice then thaws every summer, and that process will continue whatever happens.",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "title" => "Left img",
                "subtitle" => "Left img",
                "widget_category_id" => 3,
                "icon" => null,
                "widget_image" => "1671983566.avif",
                "content" => "Left img",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "title" => "A growing company",
                "subtitle" => "A growing company",
                "widget_category_id" => 3,
                "icon" => "fas fa-rocket",
                "widget_image" => null,
                "content" => "The extension comes with three pre-built pages to help you get started faster. You can change the text and images and you're good to go.\n\nCarefully crafted components\nAmazing page examples\nDynamic components",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "title" => "Here are our heroes",
                "subtitle" => "Here are our heroes",
                "widget_category_id" => 4,
                "icon" => null,
                "widget_image" => null,
                "content" => "According to the National Oceanic and Atmospheric Administration, Ted, Scambos, NSIDClead scentist, puts the potentially record maximum.",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "title" => "Ryan Tompson",
                "subtitle" => "Ryan Tompson",
                "widget_category_id" => 4,
                "icon" => null,
                "widget_image" => "1671994172.jpg",
                "content" => "<p>WEB DEVELOPER</p>",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "title" => "Romina Hadid",
                "subtitle" => "Romina Hadid",
                "widget_category_id" => 4,
                "icon" => null,
                "widget_image" => "1671983841.jpg",
                "content" => "MARKETING SPECIALIST",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "title" => "Alexa Smith",
                "subtitle" => "Alexa Smith",
                "widget_category_id" => 4,
                "icon" => null,
                "widget_image" => "1671983917.jpg",
                "content" => "UI/UX DESIGNER",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "title" => "Jenna Kardi",
                "subtitle" => "Jenna Kardi",
                "widget_category_id" => 4,
                "icon" => null,
                "widget_image" => "1671983965.png",
                "content" => "FOUNDER AND CEO",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "title" => "Build something",
                "subtitle" => "Build something",
                "widget_category_id" => 5,
                "icon" => null,
                "widget_image" => null,
                "content" => "Put the potentially record low maximum sea ice extent tihs year down to low ice. According to the National Oceanic and Atmospheric Administration, Ted, Scambos.",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "title" => "Excelent Services",
                "subtitle" => "Excelent Services",
                "widget_category_id" => 5,
                "icon" => "fas fa-medal",
                "widget_image" => null,
                "content" => "Some quick example text to build on the card title and make up the bulk of the card's content.",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "title" => "Grow your market",
                "subtitle" => "Grow your market",
                "widget_category_id" => 5,
                "icon" => "fas fa-poll",
                "widget_image" => null,
                "content" => "Some quick example text to build on the card title and make up the bulk of the card's content.",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "title" => "Launch time",
                "subtitle" => "Launch time",
                "widget_category_id" => 5,
                "icon" => "fas fa-lightbulb",
                "widget_image" => null,
                "content" => "Some quick example text to build on the card title and make up the bulk of the card's content.",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "title" => "Want to work with us?",
                "subtitle" => "Want to work with us?",
                "widget_category_id" => 5,
                "icon" => null,
                "widget_image" => null,
                "content" => "Complete this form and we will get back to you in 24 hours.",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "title" => "Let's keep in touch!",
                "subtitle" => "Let's keep in touch!",
                "widget_category_id" => 6,
                "icon" => null,
                "widget_image" => null,
                "content" => "Find us on any of these platforms, we respond 1-2 business days.",
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        DB::table('widgets')->insert($widgets);
    }
}
