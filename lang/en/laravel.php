<?php

return [
    'seo' => [
        'title' => 'Laravel Development: Modules, Portals & Admin Panels | DigiSpace',
        'description' => 'Laravel development for new and existing products: user portals, Filament admin panels, Vue/Nuxt frontends, and integrations. From $2,400 net or $35/hr for smaller tasks.',
    ],

    'nav' => [
        'proofs' => 'Projects',
        'guarantees' => 'How we work',
        'pricing' => 'Pricing',
        'faq' => 'FAQ',
        'cta' => 'Get an estimate',
        'skip' => 'Skip to content',
        'theme_toggle' => 'Switch light / dark theme',
    ],

    'hero' => [
        'badge' => 'Laravel development · PHP & Filament',
        'title' => 'Laravel development: modules, portals and web apps',
        'subtitle' => 'We build new Laravel applications and dedicated modules: user dashboards, order processing, Filament admin panels, Vue/Nuxt frontends and external integrations. Take on a fixed-scope milestone or add a senior engineer to your team.',
        'subtitle_short' => 'We build modules, user portals, Filament admin panels and web apps on Laravel. Scope, budget and timeline are agreed before work starts.',
        'cta_primary' => 'Get a task estimate',
        'status' => 'Taking on new projects',
        'metric_labels' => [
            'price' => 'Budget',
            'timeline' => 'Timeline',
            'ownership' => 'Transparency',
        ],
        'metrics' => [
            'price' => 'From $2,400 net',
            'timeline' => 'Typically 2–6 weeks',
            'ownership' => 'Code in your GitHub & automated tests',
        ],
    ],

    'proofs' => [
        'badge' => 'Our projects',
        'title' => 'Laravel products we built and run ourselves',
        'subtitle' => 'Explore our running systems built with Laravel, Filament and Vue/Nuxt.',
        'view_live' => 'Open the product',
        'gallery_hint' => 'Screenshots from the running products',
        'gallery_open' => 'Open screenshot',
        'gallery_close' => 'Close',
        'gallery_prev' => 'Previous screenshot',
        'gallery_next' => 'Next screenshot',
        'gallery_count' => 'Screenshots: :count',
        'projects' => [
            'digipulse' => [
                'badge' => 'Our own Laravel product',
                'name' => 'DigiPulse',
                'screens' => [
                    ['file' => 'digipulse-dashboard', 'caption' => 'Website overview: availability, response times and SSL certificates (site names blurred)'],
                    ['file' => 'digipulse-history', 'caption' => 'Site history: response times and incidents over the past week'],
                ],
                'tagline' => 'Website uptime monitoring powered by Laravel Octane, Filament and Go',
                'stack' => ['Laravel Octane', 'Filament', 'PostgreSQL', 'Redis', 'Go'],
                'live_url' => 'https://digipulse.cloud',
            ],
            'vetspace' => [
                'badge' => 'B2B platform on Laravel + Nuxt',
                'name' => 'VetSpace & VetCard',
                'screens' => [
                    ['file' => 'vetspace-clinic-month', 'caption' => 'Monthly calendar: daily appointment counts for each doctor (demo data)'],
                    ['file' => 'vetspace-clinic-calendar', 'caption' => 'Appointment calendar: filters by branch and doctor (demo data)'],
                    ['file' => 'vetspace-admin-plans', 'caption' => 'Filament admin panel: subscription plans synced with Stripe'],
                    ['file' => 'vetspace-swagger-appointments', 'caption' => 'API documentation: requests for managing appointments'],
                ],
                'tagline' => 'Platform for veterinary clinics: Laravel API, Nuxt frontend and Stripe billing',
                'stack' => ['Laravel API', 'Nuxt SSR', 'Filament', 'Stripe Cashier', 'PostgreSQL'],
                'live_url' => 'https://vetspace.pro',
            ],
            'netpostpanel' => [
                'name' => 'NetPostPanel',
                'mention' => 'We also built :name, an internal tool for AI-assisted source research and drafting: RAG over our own sources with Qdrant and Langfuse. The AI generation and translation on this site run on it.',
                'live_url' => 'https://github.com/Yurij2015/net-post-panel-overview',
                'link_label' => 'Read the overview on GitHub',
            ],
        ],
    ],

    'engine' => [
        'title' => 'What we build with Laravel',
        'subtitle' => 'We design the data model, backend logic and interface around your product requirements.',
        'pillars' => [
            'multitenancy' => [
                'title' => 'User portals, roles and access control',
            ],
            'billing' => [
                'title' => 'Order processing, payments and Stripe subscriptions',
            ],
            'workers' => [
                'title' => 'Queues, background jobs and notifications (Redis)',
            ],
            'admin' => [
                'title' => 'Admin panels and internal CRMs with Filament',
            ],
            'ai' => [
                'title' => 'Interfaces with Vue / Nuxt, Livewire and Blade',
            ],
            'devops' => [
                'title' => 'Automated tests, CI/CD and Docker deployment',
            ],
        ],
    ],

    'guarantees' => [
        'badge' => 'How we work',
        'title' => 'What you can count on',
        'subtitle' => 'Access to code during development, staging previews and direct communication with the developer.',
        'items' => [
            'staging' => [
                'badge' => 'Preview',
                'title' => 'Check changes before release',
                'desc' => 'We deploy completed modules to a test environment during development so you can verify user flows and request adjustments early.',
            ],
            'testing' => [
                'badge' => 'Tests',
                'title' => 'Automated scenario tests',
                'desc' => 'We write feature and unit tests for business logic, access permissions and core operations so new changes do not break existing flows.',
            ],
            'ownership' => [
                'badge' => 'Collaboration',
                'title' => 'Work inside your repository',
                'desc' => 'We work through pull requests in your GitHub or GitLab repository, or provide access to ours. We agree on the setup at the start.',
            ],
            'direct' => [
                'badge' => 'Direct contact',
                'title' => 'Direct communication with the developer',
                'desc' => 'You discuss requirements, constraints and technical decisions directly with the engineer writing the code.',
            ],
        ],
    ],

    'process' => [
        'title' => 'Four stages of Laravel development',
        'subtitle' => 'A step-by-step plan from scoping to release. Duration depends on scope and the state of the codebase.',
        'sprints' => [
            's1' => [
                'name' => 'Task review and data model',
                'duration' => 'Stage 1',
                'desc' => 'We inspect your existing app or requirements, design the database schema and agree on scope and cost.',
            ],
            's2' => [
                'name' => 'Backend logic and API',
                'duration' => 'Stage 2',
                'desc' => 'We build models, business logic, access checks, background queues and external integrations.',
            ],
            's3' => [
                'name' => 'Interface and admin panel',
                'duration' => 'Stage 3',
                'desc' => 'We build the user area (Blade, Livewire, Vue or Nuxt) and the Filament admin panel.',
            ],
            's4' => [
                'name' => 'Testing, release and docs',
                'duration' => 'Stage 4',
                'desc' => 'We test core scenarios, prepare the deployment plan and hand over setup and maintenance docs.',
            ],
        ],
    ],

    'pricing' => [
        'net_label' => 'net',
        'vat_note' => 'All prices are net. As a Polish VAT payer, we add VAT under Polish law (23% for clients in Poland).',
        'comparison_note' => 'You work directly with an experienced Laravel developer without intermediaries. Smaller tasks start at $35/hr after reviewing the code.',
        'badge' => 'Pricing',
        'title' => 'Two ways to work on Laravel',
        'subtitle' => 'A single module for an agreed scope, or regular monthly development for an existing product.',
        'plans' => [
            'mvp' => [
                'name' => 'Laravel module or application',
                'badge' => 'Fixed scope',
                'price' => 'from $2,400',
                'price_sub' => 'Fixed scope',
                'timeline' => 'Typically 2–6 weeks',
                'desc' => 'For a new module, user portal, Filament admin panel or custom Laravel app. Scope and final price are agreed upfront.',
                'features' => [
                    'Database design and module architecture',
                    'Laravel backend logic and permission checks',
                    'User portal or admin panel (Filament, Vue/Nuxt)',
                    'Third-party API and payment integrations',
                    'Automated tests for core business scenarios',
                    'Test environment for pre-release review',
                    'Code in your GitHub and setup documentation',
                    'Bug fixes for 2 weeks after release',
                ],
                'cta' => 'Get an estimate',
            ],
            'retainer' => [
                'name' => 'Ongoing Laravel development',
                'badge' => 'For your team or product',
                'price' => 'from $2,400',
                'price_sub' => 'Per month · or from $35/hr',
                'timeline' => 'Monthly',
                'desc' => 'Join your team or evolve a live product: new features, refactoring, integrations and code review.',
                'features' => [
                    'Agreed weekly capacity',
                    'Work directly in your GitHub, Jira or Linear',
                    'New features and faster database queries',
                    'Automated tests and CI/CD maintenance',
                    'Direct communication on Telegram or Slack',
                    'Weekly summary of completed tasks',
                ],
                'cta' => 'Discuss collaboration',
            ],
        ],
    ],

    'social_proof' => [
        'badge' => 'Reviews & recommendations',
        'items' => [
            'upwork' => [
                'quote' => 'He was able to design the database, set up the code architecture, and plan for future releases. He works independently, reviews and debugs code, and consistently suggests improvements while spotting logical flaws in the system. … He has always been available to support the project when needed, never makes excuses, and communicates clearly.',
                'source' => 'Client review on Upwork',
                'url' => 'https://www.upwork.com/freelancers/mokryiyurii',
            ],
            'linkedin' => [
                'quote' => 'Yurii is a responsible specialist who can work autonomously on a wide range of tasks. He has solid expertise in PHP (Symfony, Laravel) and JavaScript frameworks (Vue.js, Angular) — able to independently investigate complex issues, identify root causes, and implement effective solutions.',
                'source' => 'Recommendation on LinkedIn',
                'url' => 'https://linkedin.com/in/yurii-mokryi',
            ],
        ],
    ],

    'founder' => [
        'badge' => 'Who you will work with',
        'name' => 'Yurii Mokryi',
        'role' => 'Founder of DigiSpace · Solutions Architect & Lead Engineer',
        'bio' => "I build commercial web applications with PHP, Laravel and Symfony: from client marketplaces and CRMs to my own products DigiPulse and VetSpace.\n\nI start by reviewing real requirements, data structure and project constraints. You see working progress in a test environment at every stage.",
        'more_links' => 'Videos and blog',
        'facts' => [
            '8+ years of commercial development',
            'Laravel, Filament, Vue/Nuxt, PostgreSQL, Docker',
            'My own products: DigiPulse, VetSpace, NetPostPanel',
            'Remote collaboration across Ukraine, the EU and the US',
        ],
        'links' => [
            'linkedin' => 'https://linkedin.com/in/yurii-mokryi',
            'github' => 'https://github.com/Yurij2015',
            'upwork' => 'https://www.upwork.com/freelancers/mokryiyurii',
            'youtube' => 'https://www.youtube.com/@YuriiMokryi',
            'tiktok' => 'https://www.tiktok.com/@yriimokryi',
            'instagram' => 'https://www.instagram.com/yurii_mokryi',
        ],
    ],

    'faq' => [
        'badge' => 'FAQ',
        'title' => 'Common questions about Laravel development',
        'subtitle' => 'Existing codebases, Filament, code access and payments.',
        'items' => [
            'q1' => [
                'q' => 'Can you work on an existing Laravel application?',
                'a' => 'Yes. First we inspect the repository, database structure, dependencies and deployment setup. Then we plan changes so the new module fits your existing workflows.',
            ],
            'q2' => [
                'q' => 'Do you build Filament admin panels and Vue or Nuxt frontends?',
                'a' => 'Yes. We build admin panels and internal tools with Filament, and user interfaces with Vue/Nuxt, Livewire or Blade depending on the project.',
            ],
            'q3' => [
                'q' => 'How is code access managed?',
                'a' => 'We work in your GitHub or GitLab repository via pull requests, or grant access to ours. Code handover terms are agreed before work begins.',
            ],
            'q4' => [
                'q' => 'What do you need to provide an estimate?',
                'a' => 'A short description of the task, mockups or a link to your current app. For existing apps, a brief code walkthrough helps make the estimate accurate.',
            ],
            'q5' => [
                'q' => 'How do you check that new changes will not break live features?',
                'a' => 'We cover key scenarios with automated tests, verify changes on a test environment and prepare a step-by-step release plan.',
            ],
            'q6' => [
                'q' => 'How does payment work?',
                'a' => 'Fixed-scope projects are split into milestone payments (invoice or escrow). Monthly or hourly work is billed by invoice on an agreed schedule.',
            ],
            'q7' => [
                'q' => 'Which countries do you work with?',
                'a' => 'We work remotely with clients in Ukraine, Poland, the EU, the UK, the US and Canada. We communicate in Ukrainian, English and Polish.',
            ],
        ],
    ],

    'contact' => [
        'badge' => 'Get in touch',
        'title' => 'Tell us about your Laravel task',
        'subtitle' => 'Describe what you want to build or improve. We will clarify details and send an initial estimate.',
        'telegram_cta' => 'Message on Telegram',
        'telegram_hint' => 'We usually reply the same day',
        'email_cta' => 'Send an email',
        'form' => [
            'project_name' => 'Your name or company',
            'project_name_placeholder' => 'Alex / Company Ltd',
            'contact' => 'Telegram or email',
            'contact_placeholder' => '@username or name@company.com',
            'stage' => 'Project stage',
            'not_specified' => 'Not specified',
            'stage_options' => [
                'idea' => 'New product or module from scratch',
                'spec' => 'I have a brief or mockups',
                'rewrite' => 'Existing Laravel app that needs new features',
            ],
            'budget' => 'Estimated budget',
            'budget_options' => [
                'sprint' => '$2,400 – $5,000 (module / portal)',
                'custom' => '$5,000+ (full application)',
                'retainer' => 'Monthly collaboration / hourly',
            ],
            'description' => 'Short task description',
            'description_placeholder' => 'What features do you need built or improved in Laravel?',
            'submit' => 'Get an estimate',
            'response_time' => 'We reply within one business day.',
            'errors_title' => 'Please check the form:',
            'validation' => [
                'required' => 'Please fill in “:attribute”.',
                'max' => '“:attribute” is too long (up to :max characters).',
                'invalid' => 'Please choose a value from the list for “:attribute”.',
            ],
            'recaptcha_failed' => 'The reCAPTCHA check failed. Please try again or message us on Telegram.',
            'recaptcha_notice' => 'Protected by reCAPTCHA:',
            'recaptcha_privacy' => 'Google Privacy Policy',
            'recaptcha_terms' => 'Terms of Service',
            'privacy_notice' => 'The data controller is Yurii Mokryi JDG. We use the data from this form only to reply to your inquiry.',
            'success_title' => 'Thank you!',
            'success_message' => 'We have received your message. Within one business day, we will send follow-up questions or an initial estimate.',
        ],
    ],

    'footer' => [
        'legal' => 'Yurii Mokryi JDG · NIP 7773404080 · REGON 524949632',
        'privacy_policy' => 'Privacy policy',
        'tagline' => 'Laravel, Symfony and PHP development',
        'all_rights_reserved' => 'All rights reserved',
        'location' => 'Stęszew near Poznań, Wielkopolska, Poland.',
    ],
];
