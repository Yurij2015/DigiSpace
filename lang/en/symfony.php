<?php

return [
    'seo' => [
        'title' => 'Symfony Development: Modules, APIs, Payments & Queues | DigiSpace',
        'description' => 'Symfony development and maintenance: order processing, payment integrations, APIs, Symfony Messenger queues and version upgrades. From $3,200 net.',
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
        'badge' => 'Symfony development · PHP & Doctrine',
        'title' => 'Symfony development and application evolution',
        'subtitle' => 'We help evolve existing Symfony applications and build new modules: order processing, payment integrations, APIs and background jobs. Changes to complex business logic are verified in staging before release.',
        'subtitle_short' => 'We add modules, APIs, payment integrations and background workflows to Symfony applications. Scope, budget and rollout plan are agreed upfront.',
        'cta_primary' => 'Get a task estimate',
        'status' => 'Taking on new projects',
        'metric_labels' => [
            'price' => 'Budget',
            'timeline' => 'Timeline',
            'ownership' => 'Approach',
        ],
        'metrics' => [
            'price' => 'From $3,200 net',
            'timeline' => 'Typically 3–6 weeks',
            'ownership' => 'PHPUnit, PHPStan & staged rollout',
        ],
    ],

    'proofs' => [
        'badge' => 'Our projects',
        'title' => 'Systems we build and maintain',
        'subtitle' => 'Commercial Symfony experience (including busy ticketing stores with order and payment flows) alongside our own PHP products.',
        'view_live' => 'Open the product',
        'gallery_hint' => 'Screenshots from the running products',
        'gallery_open' => 'Open screenshot',
        'gallery_close' => 'Close',
        'gallery_prev' => 'Previous screenshot',
        'gallery_next' => 'Next screenshot',
        'gallery_count' => 'Screenshots: :count',
        'projects' => [
            'digipulse' => [
                'badge' => 'Our own SaaS product',
                'name' => 'DigiPulse',
                'screens' => [
                    ['file' => 'digipulse-dashboard', 'caption' => 'Website overview: availability, response times and SSL certificates (site names blurred)'],
                    ['file' => 'digipulse-history', 'caption' => 'Site history: response times and incidents over the past week'],
                ],
                'tagline' => 'Website uptime monitoring with alerts and background processing',
                'stack' => ['PHP 8', 'PostgreSQL', 'Redis', 'Go', 'Docker'],
                'live_url' => 'https://digipulse.cloud',
            ],
            'vetspace' => [
                'badge' => 'Multi-tenant B2B platform',
                'name' => 'VetSpace & VetCard',
                'screens' => [
                    ['file' => 'vetspace-clinic-month', 'caption' => 'Monthly calendar: daily appointment counts for each doctor (demo data)'],
                    ['file' => 'vetspace-clinic-calendar', 'caption' => 'Appointment calendar: filters by branch and doctor (demo data)'],
                    ['file' => 'vetspace-admin-plans', 'caption' => 'Admin panel: subscription plans synced with Stripe'],
                    ['file' => 'vetspace-swagger-appointments', 'caption' => 'API documentation: requests for managing appointments'],
                ],
                'tagline' => 'B2B platform with OpenAPI docs, access control and Stripe subscriptions',
                'stack' => ['PHP API', 'PostgreSQL', 'Stripe', 'OpenAPI', 'Nuxt SSR'],
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
        'title' => 'What we work on in Symfony',
        'subtitle' => 'We work with both new services and live production systems on Symfony 5, 6 and 7.',
        'pillars' => [
            'multitenancy' => [
                'title' => 'Business logic, modules and Doctrine ORM',
            ],
            'billing' => [
                'title' => 'Order processing and payment integrations',
            ],
            'workers' => [
                'title' => 'Symfony Messenger and queues (Redis / RabbitMQ)',
            ],
            'admin' => [
                'title' => 'REST APIs, OpenAPI and external integrations',
            ],
            'ai' => [
                'title' => 'Staged Symfony and PHP version upgrades',
            ],
            'devops' => [
                'title' => 'PHPUnit, PHPStan and Docker deployment',
            ],
        ],
    ],

    'guarantees' => [
        'badge' => 'How we work',
        'title' => 'What you can count on',
        'subtitle' => 'Staged releases, static analysis and direct collaboration with the developer.',
        'items' => [
            'staging' => [
                'badge' => 'Staging',
                'title' => 'Staging check before release',
                'desc' => 'All changes go to a test environment first so you can check user flows and data exchange before production rollout.',
            ],
            'testing' => [
                'badge' => 'Tests',
                'title' => 'Automated tests and static analysis',
                'desc' => 'We add PHPUnit tests for key flows and run PHPStan checks to reduce the risk of regressions.',
            ],
            'ownership' => [
                'badge' => 'Collaboration',
                'title' => 'Work inside your Git workflow',
                'desc' => 'We follow your team’s standards through pull requests with clear change summaries and documentation.',
            ],
            'direct' => [
                'badge' => 'Direct contact',
                'title' => 'Direct line to the engineer',
                'desc' => 'You discuss architecture, constraints and priorities directly with the developer doing the work.',
            ],
        ],
    ],

    'process' => [
        'title' => 'Four stages of Symfony delivery',
        'subtitle' => 'A step-by-step workflow that lowers risk when modifying a live application.',
        'sprints' => [
            's1' => [
                'name' => 'Codebase and requirements review',
                'duration' => 'Stage 1',
                'desc' => 'We inspect architecture, Doctrine schema and dependencies to agree on a realistic delivery plan.',
            ],
            's2' => [
                'name' => 'Modules and background queues',
                'duration' => 'Stage 2',
                'desc' => 'We build services, controllers, Messenger handlers and integrations per the agreed scope.',
            ],
            's3' => [
                'name' => 'Testing and query checks',
                'duration' => 'Stage 3',
                'desc' => 'We add automated tests, review SQL queries and test edge cases in external data exchange.',
            ],
            's4' => [
                'name' => 'Release and documentation',
                'duration' => 'Stage 4',
                'desc' => 'We support production deployment, check logs and hand over a summary of the changes.',
            ],
        ],
    ],

    'pricing' => [
        'net_label' => 'net',
        'vat_note' => 'All prices are net. As a Polish VAT payer, we add VAT under Polish law (23% for clients in Poland).',
        'comparison_note' => 'You work directly with the engineer without intermediaries. Final scope and price are agreed after reviewing the codebase.',
        'badge' => 'Pricing',
        'title' => 'Ways to work together on Symfony',
        'subtitle' => 'A fixed-scope module or ongoing monthly development for a live application.',
        'plans' => [
            'mvp' => [
                'name' => 'Symfony module or feature',
                'badge' => 'Fixed scope',
                'price' => 'from $3,200',
                'price_sub' => 'Fixed scope',
                'timeline' => 'Typically 3–6 weeks',
                'desc' => 'For a new module, payment or API integration, or reworking a critical part of your application.',
                'features' => [
                    'Review of current architecture and Doctrine models',
                    'Business logic, services and REST API development',
                    'Background job handling with Symfony Messenger',
                    'Payment and external service integrations',
                    'PHPUnit tests and PHPStan checks',
                    'Test environment for pre-release verification',
                    'Code in your repository and change documentation',
                    'Bug fixes for 2 weeks after release',
                ],
                'cta' => 'Get an estimate',
            ],
            'retainer' => [
                'name' => 'Ongoing Symfony development',
                'badge' => 'For a live product',
                'price' => 'from $2,400',
                'price_sub' => 'Per month · or from $35/hr',
                'timeline' => 'Monthly',
                'desc' => 'Regular platform evolution, gradual Symfony and PHP upgrades, faster queries and team support.',
                'features' => [
                    'Agreed weekly development hours',
                    'New features and root-cause bug fixes',
                    'Faster Doctrine queries and queue tuning',
                    'Incremental Symfony and PHP version upgrades',
                    'Direct Telegram or Slack channel',
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
        'bio' => "I work with commercial PHP systems in Symfony and Laravel, including ticketing stores, order processing, payment gateways and background queues.\n\nI start by reading the existing code, dependencies and constraints, then propose a clear plan with controlled risk.",
        'more_links' => 'Videos and blog',
        'facts' => [
            '8+ years of commercial development',
            'Symfony, Doctrine, Messenger, PostgreSQL, Docker',
            'Experience with orders, payments and queues',
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
        'title' => 'Common questions about Symfony development',
        'subtitle' => 'Versions, working with your team, tests and billing.',
        'items' => [
            'q1' => [
                'q' => 'Which Symfony versions do you work with?',
                'a' => 'We work with Symfony 5, 6 and 7, and also plan staged upgrades from older versions including bundle checks and PHP 8.x compatibility.',
            ],
            'q2' => [
                'q' => 'Can you join our existing engineering team?',
                'a' => 'Yes. We can own a dedicated module or work inside your team’s GitHub/GitLab and Jira/Linear workflow.',
            ],
            'q3' => [
                'q' => 'Do you work with Symfony Messenger and APIs?',
                'a' => 'Yes, we build REST APIs with OpenAPI documentation and async processing via Messenger with Redis or RabbitMQ.',
            ],
            'q4' => [
                'q' => 'What do you need to estimate a task?',
                'a' => 'A short description of the task plus your Symfony and PHP versions. For existing apps, a quick repository review helps spot constraints early.',
            ],
            'q5' => [
                'q' => 'How do you reduce the risk of production bugs?',
                'a' => 'We write PHPUnit unit and integration tests, run PHPStan static analysis and verify flows on staging before releasing.',
            ],
            'q6' => [
                'q' => 'How does payment work?',
                'a' => 'Milestone payments for fixed-scope work, or monthly/hourly invoicing. Escrow is also possible.',
            ],
            'q7' => [
                'q' => 'Do you work with clients outside Poland?',
                'a' => 'Yes. We work remotely with teams in Ukraine, Poland, the EU, the UK, the US and Canada.',
            ],
        ],
    ],

    'contact' => [
        'badge' => 'Get in touch',
        'title' => 'Tell us about your Symfony project',
        'subtitle' => 'Describe your module, integration or issue. We will clarify details and send an initial estimate.',
        'telegram_cta' => 'Message on Telegram',
        'telegram_hint' => 'We usually reply the same day',
        'email_cta' => 'Send an email',
        'form' => [
            'project_name' => 'Your name or company',
            'project_name_placeholder' => 'Alex / Tech GmbH',
            'contact' => 'Telegram or email',
            'contact_placeholder' => '@username or name@company.com',
            'stage' => 'Project stage',
            'not_specified' => 'Not specified',
            'stage_options' => [
                'idea' => 'New service or module',
                'spec' => 'I have a technical brief or requirements',
                'rewrite' => 'Existing Symfony system to evolve or upgrade',
            ],
            'budget' => 'Estimated budget',
            'budget_options' => [
                'sprint' => '$3,200 – $6,500 (module / integration)',
                'custom' => '$6,500+ (larger scope)',
                'retainer' => 'Monthly collaboration / hourly',
            ],
            'description' => 'Short task description',
            'description_placeholder' => 'Which Symfony version are you on, and what needs to be built?',
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
