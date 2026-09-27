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
    // Country pre-selected in the contact form's phone field, per locale (intl-tel-input ISO-3166).
    // A locale is not a country, so this is a best guess for the visitor's most likely dial code,
    // never a restriction: every country stays selectable in the dropdown.
    'phone_country' => [
        'en' => 'gb',
        'uk' => 'ua',
        'pl' => 'pl',
    ],
    'route_names' => [
        'home.index', 'about', 'services', 'pricing', 'promos', 'blog',
        'blog-category', 'blog-archive', 'blog-search', 'contact-us',
        'contact.save', 'subscriber-save', 'pages.page', 'blog.post', 'error-404',
        'category-services', 'category-service', 'service-search',
        'privacy-policy', 'faq', 'support',
    ],
];
