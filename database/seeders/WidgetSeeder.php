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
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                'title' => 'Awarded Agency',
                'subtitle' => 'Awarded Agency',
                'widget_category_id' => 2,
                'icon' => 'fas fa-award',
                'widget_image' => '',
                'content' => 'Divide details about your product or agency work into parts. A paragraph describing a feature will be enough.',
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                'title' => 'Free Revisions',
                'subtitle' => 'Free Revisions',
                'widget_category_id' => 2,
                'icon' => 'fas fa-retweet',
                'widget_image' => '',
                'content' => 'Keep you user engaged by providing meaningful information. Remember that by this time, the user is curious.',
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                'title' => 'Verified Company',
                'subtitle' => 'Verified Company',
                'widget_category_id' => 2,
                'icon' => 'fas fa-fingerprint',
                'widget_image' => '',
                'content' => 'Write a few lines about each one. A paragraph describing a feature will be enough. Keep you user engaged!',
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Working with us is a pleasure",
                "subtitle" => "Check free DigiSpace CMS!",
                "widget_category_id" => 3,
                "icon" => "fas fa-user-friends",
                "widget_image" => null,
                "content" => "<p class='text-lg font-light leading-relaxed mt-4 mb-4 text-blueGray-600'>Don't let your uses guess by attaching tooltips and popoves to any element. Just make sure you enable them first via JavaScript. </p><p class='text-lg font-light leading-relaxed mt-0 mb-4 text-blueGray-600'>The kit comes with three pre-built pages to help you get started faster. You can change the text and images and you're good to go. Just make sure you enable them first via JavaScript.</p>",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Top Notch Services",
                "subtitle" => "Top Notch Services",
                "widget_category_id" => 3,
                "icon" => null,
                "widget_image" => "1671983508.avif",
                "content" => "The Arctic Ocean freezes every winter and much of the sea-ice then thaws every summer, and that process will continue whatever happens.",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Left img",
                "subtitle" => "Left img",
                "widget_category_id" => 3,
                "icon" => null,
                "widget_image" => "1671983566.avif",
                "content" => "Left img",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "A growing company",
                "subtitle" => "A growing company",
                "widget_category_id" => 3,
                "icon" => "fas fa-rocket",
                "widget_image" => null,
                "content" => "The extension comes with three pre-built pages to help you get started faster. You can change the text and images and you're good to go.\n\nCarefully crafted components\nAmazing page examples\nDynamic components",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Here are our heroes",
                "subtitle" => "Here are our heroes",
                "widget_category_id" => 4,
                "icon" => null,
                "widget_image" => null,
                "content" => "According to the National Oceanic and Atmospheric Administration, Ted, Scambos, NSIDClead scentist, puts the potentially record maximum.",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Ryan Tompson",
                "subtitle" => "Ryan Tompson",
                "widget_category_id" => 4,
                "icon" => null,
                "widget_image" => "1671994172.jpg",
                "content" => "<p>WEB DEVELOPER</p>",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Romina Hadid",
                "subtitle" => "Romina Hadid",
                "widget_category_id" => 4,
                "icon" => null,
                "widget_image" => "1671983841.jpg",
                "content" => "MARKETING SPECIALIST",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Alexa Smith",
                "subtitle" => "Alexa Smith",
                "widget_category_id" => 4,
                "icon" => null,
                "widget_image" => "1671983917.jpg",
                "content" => "UI/UX DESIGNER",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Jenna Kardi",
                "subtitle" => "Jenna Kardi",
                "widget_category_id" => 4,
                "icon" => null,
                "widget_image" => "1671983965.png",
                "content" => "FOUNDER AND CEO",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Build something",
                "subtitle" => "Build something",
                "widget_category_id" => 5,
                "icon" => null,
                "widget_image" => null,
                "content" => "Put the potentially record low maximum sea ice extent tihs year down to low ice. According to the National Oceanic and Atmospheric Administration, Ted, Scambos.",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Excelent Services",
                "subtitle" => "Excelent Services",
                "widget_category_id" => 5,
                "icon" => "fas fa-medal",
                "widget_image" => null,
                "content" => "Some quick example text to build on the card title and make up the bulk of the card's content.",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Grow your market",
                "subtitle" => "Grow your market",
                "widget_category_id" => 5,
                "icon" => "fas fa-poll",
                "widget_image" => null,
                "content" => "Some quick example text to build on the card title and make up the bulk of the card's content.",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Launch time",
                "subtitle" => "Launch time",
                "widget_category_id" => 5,
                "icon" => "fas fa-lightbulb",
                "widget_image" => null,
                "content" => "Some quick example text to build on the card title and make up the bulk of the card's content.",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Want to work with us?",
                "subtitle" => "Want to work with us?",
                "widget_category_id" => 5,
                "icon" => null,
                "widget_image" => null,
                "content" => "Complete this form and we will get back to you in 24 hours.",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Let's keep in touch!",
                "subtitle" => "Let's keep in touch!",
                "widget_category_id" => 6,
                "icon" => null,
                "widget_image" => null,
                "content" => "Find us on any of these platforms, we respond 1-2 business days.",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "What we do",
                "subtitle" => "Developing High-quality Apps",
                "widget_category_id" => 7,
                "icon" => null,
                "widget_image" => null,
                "content" => "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => 'active show',
                'anchor' => '#tabs-about-1',
                'element_id' => 'tabs-about-1'
            ],
            [
                "title" => "Our Mission",
                "subtitle" => "Providing Reliable Software",
                "widget_category_id" => 7,
                "icon" => null,
                "widget_image" => null,
                "content" => "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => '#tabs-about-2',
                'element_id' => 'tabs-about-2'
            ],
            [
                "title" => "Our Goal",
                "subtitle" => "Supporting Our Clients",
                "widget_category_id" => 7,
                "icon" => null,
                "widget_image" => null,
                "content" => "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => '#tabs-about-3',
                'element_id' => 'tabs-about-3'
            ],
            [
                "title" => "Ann Peterson",
                "subtitle" => "UI Designer",
                "widget_category_id" => 8,
                "icon" => null,
                "widget_image" => '1673141363.jpg',
                "content" => "UI Designer",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Sam Williams",
                "subtitle" => "Lead Developer",
                "widget_category_id" => 8,
                "icon" => null,
                "widget_image" => '1673141408.jpg',
                "content" => "Lead Developer",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Emily Smith",
                "subtitle" => "Marketing Manager",
                "widget_category_id" => 8,
                "icon" => null,
                "widget_image" => '1673141448.jpg',
                "content" => "Marketing Manager",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Apps Installed",
                "subtitle" => "1.",
                "widget_category_id" => 9,
                "icon" => 'k',
                "widget_image" => null,
                "content" => "8",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Awards Won",
                "subtitle" => null,
                "widget_category_id" => 9,
                "icon" => null,
                "widget_image" => null,
                "content" => "27",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Staff Members",
                "subtitle" => null,
                "widget_category_id" => 9,
                "icon" => '+',
                "widget_image" => null,
                "content" => "45",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Satisfied Customers",
                "subtitle" => null,
                "widget_category_id" => 9,
                "icon" => '%',
                "widget_image" => null,
                "content" => "99",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Michael Johnson",
                "subtitle" => 'Regular Client',
                "widget_category_id" => 10,
                "icon" => null,
                "widget_image" => '1673227358.jpg',
                "content" => "<p>TechSoft offers a high caliber of resources skilled in Microsoft Azure .NET mobile and Quality Assurance. They became our true business partners over the past three years of our cooperation.</p>",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Rachel Adams",
                "subtitle" => 'Regular Client',
                "widget_category_id" => 10,
                "icon" => null,
                "widget_image" => '1673227369.jpg',
                "content" => "<p>DigiSpace is a highly skilled and uniquely capable firm with multitudes of talent on-board. We have collaborated on a number of diverse projects that have been a great success.</p>",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Phone",
                "subtitle" => '1-800-700-6200',
                "widget_category_id" => 11,
                "icon" => 'fl-bigmug-line-headphones32',
                "widget_image" => null,
                "content" => "Our Support Service is always available 24 hours a day",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Subscribe",
                "subtitle" => 'Get the latest updates and offers',
                "widget_category_id" => 11,
                "icon" => null,
                "widget_image" => null,
                "content" => "Your E-mail",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "About us",
                "subtitle" => 'Our company has been developing high-quality and reliable software fof corporate needs since 2008.',
                "widget_category_id" => 11,
                "icon" => null,
                "widget_image" => null,
                "content" => "About us",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Latest news",
                "subtitle" => null,
                "widget_category_id" => 11,
                "icon" => null,
                "widget_image" => null,
                "content" => "Latest news",
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Useful Links",
                "subtitle" => null,
                "widget_category_id" => 11,
                "icon" => null,
                "widget_image" => null,
                "content" => 'Useful Links',
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "High Quality Hardware",
                "subtitle" => null,
                "widget_category_id" => 12,
                "icon" => "linearicons-cog",
                "widget_image" => null,
                "content" => 'We use top-notch hardware to develop the most efficient apps for our customers.',
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Dedicated 24/7 Support",
                "subtitle" => null,
                "widget_category_id" => 12,
                "icon" => 'linearicons-headset',
                "widget_image" => null,
                "content" => 'You can rely on our 24/7 tech support that will gladly solve any app issue you may have.',
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "30-Day Money-back Guarantee",
                "subtitle" => null,
                "widget_category_id" => 12,
                "icon" => 'linearicons-wallet',
                "widget_image" => null,
                "content" => 'If you are not satisfied with our apps, we will return your money in the first 30 days.',
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Agile and Fast Working Style",
                "subtitle" => null,
                "widget_category_id" => 12,
                "icon" => 'linearicons-rocket',
                "widget_image" => null,
                "content" => 'This type of approach to our work helps our specialists to quickly develop better apps.',
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Some Apps are Free",
                "subtitle" => null,
                "widget_category_id" => 12,
                "icon" => 'linearicons-rocket',
                "widget_image" => null,
                "content" => 'We also develop free apps that can be downloaded online without any payments.',
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "High Level of Usability",
                "subtitle" => null,
                "widget_category_id" => 12,
                "icon" => 'linearicons-thumbs-up',
                "widget_image" => null,
                "content" => 'All our products have high usability allowing users to easily operate the apps.',
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Can I track my order?",
                "subtitle" => 'left',
                "widget_category_id" => 13,
                "icon" => null,
                "widget_image" => null,
                "content" => '<p>Yes, you can! After placing your order you will receive an order confirmation via email. Each order starts production 24 hours after your order is placed. Within 72 hours of you placing your order, you will receive an expected delivery date. When the order ships, you will receive another email with the tracking number and a link.</p>',
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => 'show',
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "How can I change something in my order?",
                "subtitle" => 'left',
                "widget_category_id" => 13,
                "icon" => null,
                "widget_image" => null,
                "content" => '<p>If you need to change something in your order, please contact us immediately. We usually process orders within 30 minutes, and once we have processed your order, we will be unable to make any changes.</p>',
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "How can I pay for my order?",
                "subtitle" => 'left',
                "widget_category_id" => 13,
                "icon" => null,
                "widget_image" => null,
                "content" => '<p>We accept Visa, MasterCard, and American Express credit and debit cards for your convenience.</p>',
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "How long will my order be delivered?",
                "subtitle" => 'right',
                "widget_category_id" => 13,
                "icon" => null,
                "widget_image" => null,
                "content" => '<p>Delivery times will depend on your location. Once payment is confirmed your order will be packaged. Delivery can be expected within a day.</p>',
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Can I return an item?",
                "subtitle" => 'right',
                "widget_category_id" => 13,
                "icon" => null,
                "widget_image" => null,
                "content" => '<p>Please contact our administrators for more information on returning products purchased on our website.</p>',
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "What is a unique/non-unique purchase?",
                "subtitle" => 'right',
                "widget_category_id" => 13,
                "icon" => null,
                "widget_image" => null,
                "content" => ' <p>Non-exclusive purchase means that other people can buy the template you have chosen some time later. Exclusive or unique purchase guarantees that you are the last person to buy this template. After an exclusive purchase occurs the template is being permanently removed from the sales directory and will never be available to other customers again. Only you and people who bought the template before you will own it.</p>',
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "Windows Applications",
                "subtitle" => 'Windows Applications',
                "widget_category_id" => 14,
                "icon" => 'fl-bigmug-line-file69',
                "widget_image" => null,
                "content" => '{"discount":"-25%", "currency":"$", "price_value":"126", "price_aside":"99", "period":"year", "price_old":"Old Price $200.00"}',
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "iOS & Android Apps",
                "subtitle" => 'iOS & Android Apps',
                "widget_category_id" => 14,
                "icon" => 'fl-bigmug-line-hot67',
                "widget_image" => null,
                "content" => '{"discount":"Free Trial", "currency":"$", "price_value":"0", "price_aside":"99",  "period":"mon", "price_old":"Old Price $100.00"}',
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => 'promo-classic__label-sm',
                'anchor' => null,
                'element_id' => null
            ],
            [
                "title" => "QA & Testing Services",
                "subtitle" => 'QA & Testing Services',
                "widget_category_id" => 14,
                "icon" => 'fl-bigmug-line-email64',
                "widget_image" => null,
                "content" => '{"discount":"-50%", "currency":"$", "price_value":"45", "price_aside":"99", "period":"mon", "price_old":"Old Price $150.00"}',
                'created_at' => now(),
                'updated_at' => now(),
                'css_class' => null,
                'anchor' => null,
                'element_id' => null
            ],
        ];
        DB::table('widgets')->insert($widgets);
    }
}
