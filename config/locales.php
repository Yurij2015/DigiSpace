<?php

return [
    'supported' => ['en', 'uk', 'pl'],
    'default' => 'en',
    'fallback' => 'en',
    'aliases' => [
        'ua' => 'uk',
    ],
    'labels' => [
        'en' => 'English',
        'uk' => 'Українська',
        'pl' => 'Polski',
    ],
    // Compact codes shown in the public header switcher (product choice: "UA" for uk).
    'short_labels' => [
        'en' => 'EN',
        'uk' => 'UA',
        'pl' => 'PL',
    ],
    'route_names' => [
        'home.index', 'about', 'services', 'pricing', 'promos', 'blog',
        'blog-category', 'blog-archive', 'blog-search', 'contact-us',
        'contact.save', 'subscriber-save', 'categories.index', 'categories.show',
        'posts.index', 'posts.show', 'pages.page', 'blog.post', 'error-404',
        'category-services', 'category-service', 'service-search',
        'privacy-policy', 'faq', 'support',
    ],
];
