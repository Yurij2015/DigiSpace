<?php

return [
    'seo' => [
        'title' => 'PHP, Laravel & Symfony Support, Upgrades & Stabilization | DigiSpace',
        'description' => 'Support and upgrades for PHP, Laravel and Symfony applications: bug fixes, version upgrades, legacy stabilization, faster pages and regular maintenance. From $35/hr or $1,600.',
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
        'badge' => 'Support & upgrades · PHP / Laravel / Symfony',
        'title' => 'Support, upgrades and stabilization for PHP projects',
        'subtitle' => 'We help with PHP, Laravel and Symfony applications that need bug fixes, version upgrades, faster response times or regular maintenance. We take on both standalone stabilization tasks and planned monthly support.',
        'subtitle_short' => 'We fix bugs, upgrade Laravel, Symfony and PHP, speed up slow pages and provide planned maintenance for live PHP applications.',
        'cta_primary' => 'Assess your project',
        'status' => 'Taking on support projects',
        'metric_labels' => [
            'price' => 'Pricing',
            'timeline' => 'Start',
            'ownership' => 'Safety',
        ],
        'metrics' => [
            'price' => 'From $35/hr or $1,600',
            'timeline' => 'Diagnostics in 1–3 days',
            'ownership' => 'Backups, tests & rollback plan',
        ],
    ],

    'proofs' => [
        'badge' => 'Our projects',
        'title' => 'Production systems we run and maintain ourselves',
        'subtitle' => 'We maintain our own live products: backups, uptime monitoring, automated tests and planned dependency updates.',
        'view_live' => 'Open the product',
        'gallery_hint' => 'Screenshots from the running products',
        'gallery_open' => 'Open screenshot',
        'gallery_close' => 'Close',
        'gallery_prev' => 'Previous screenshot',
        'gallery_next' => 'Next screenshot',
        'gallery_count' => 'Screenshots: :count',
        'projects' => [
            'digipulse' => [
                'badge' => 'Production monitoring',
                'name' => 'DigiPulse',
                'screens' => [
                    ['file' => 'digipulse-dashboard', 'caption' => 'Website overview: availability, response times and SSL certificates (site names blurred)'],
                    ['file' => 'digipulse-history', 'caption' => 'Site history: response times and incidents over the past week'],
                ],
                'tagline' => 'Our own uptime, SSL certificate and response-time monitoring service',
                'stack' => ['Laravel Octane', 'Docker', 'PostgreSQL', 'Redis', 'Monitoring'],
                'live_url' => 'https://digipulse.cloud',
            ],
            'vetspace' => [
                'badge' => 'Maintained B2B system',
                'name' => 'VetSpace & VetCard',
                'screens' => [
                    ['file' => 'vetspace-clinic-month', 'caption' => 'Monthly calendar: daily appointment counts for each doctor (demo data)'],
                    ['file' => 'vetspace-clinic-calendar', 'caption' => 'Appointment calendar: filters by branch and doctor (demo data)'],
                    ['file' => 'vetspace-admin-plans', 'caption' => 'Filament admin panel: subscription plans synced with Stripe'],
                    ['file' => 'vetspace-swagger-appointments', 'caption' => 'API documentation: requests for managing appointments'],
                ],
                'tagline' => 'Platform backed by automated tests, CI/CD deployments and regular updates',
                'stack' => ['Laravel', 'PHPUnit', 'CI/CD', 'Docker', 'PostgreSQL'],
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
        'title' => 'How we help existing PHP applications',
        'subtitle' => 'We restore control over the codebase and reduce technical debt in clear steps.',
        'pillars' => [
            'multitenancy' => [
                'title' => 'Laravel, Symfony & PHP 7 → 8.x upgrades',
            ],
            'billing' => [
                'title' => 'Legacy PHP stabilization after contractor handover',
            ],
            'workers' => [
                'title' => 'Critical bug fixes and queue recovery',
            ],
            'admin' => [
                'title' => 'Faster pages and SQL query tuning',
            ],
            'ai' => [
                'title' => 'Backups, uptime monitoring and error tracking',
            ],
            'devops' => [
                'title' => 'Docker setup and reproducible deployments',
            ],
        ],
    ],

    'guarantees' => [
        'badge' => 'How we work',
        'title' => 'Careful work on live systems',
        'subtitle' => 'Backups and an isolated test copy come first, so risky edits never happen directly on production.',
        'items' => [
            'staging' => [
                'badge' => 'Safety',
                'title' => 'Test copy and verified backup first',
                'desc' => 'We reproduce the app in a test environment and verify backup restoration before making changes on the live server.',
            ],
            'testing' => [
                'badge' => 'Control',
                'title' => 'Automated tests before upgrades',
                'desc' => 'We add tests around critical flows so framework and package updates do not introduce silent regressions.',
            ],
            'ownership' => [
                'badge' => 'Clarity',
                'title' => 'Documented environment and deploy',
                'desc' => 'We organize dependencies, environment variables and deployment steps so the project does not depend on one person.',
            ],
            'direct' => [
                'badge' => 'Direct contact',
                'title' => 'Direct contact with the developer',
                'desc' => 'You talk on Telegram or Slack directly with the engineer who knows your code and server setup.',
            ],
        ],
    ],

    'process' => [
        'title' => 'How upgrades and stabilization work',
        'subtitle' => 'Four steps from an outdated or fragile codebase to a maintainable application.',
        'sprints' => [
            's1' => [
                'name' => 'Inventory and backups',
                'duration' => 'Step 1',
                'desc' => 'We check code, credentials, database and dependencies, and set up verified backups.',
            ],
            's2' => [
                'name' => 'Test copy and diagnostics',
                'duration' => 'Step 2',
                'desc' => 'We spin up an isolated copy, reproduce issues and agree on the fix or upgrade scope and cost.',
            ],
            's3' => [
                'name' => 'Fixes, upgrades and tests',
                'duration' => 'Step 3',
                'desc' => 'We clear blockers, upgrade PHP, Laravel or Symfony, speed up slow queries and run tests.',
            ],
            's4' => [
                'name' => 'Release with a rollback plan',
                'duration' => 'Step 4',
                'desc' => 'We deploy with a tested rollback plan, check logs and move to ongoing maintenance if needed.',
            ],
        ],
    ],

    'pricing' => [
        'net_label' => 'net',
        'vat_note' => 'All prices are net. As a Polish VAT payer, we add VAT under Polish law (23% for clients in Poland).',
        'comparison_note' => 'Small tasks start at $35/hr after reviewing the task and code. Upgrades and stabilization are agreed as a fixed stage.',
        'badge' => 'Pricing',
        'title' => 'Support and upgrade formats',
        'subtitle' => 'A one-off upgrade or stabilization stage, or regular monthly maintenance.',
        'plans' => [
            'mvp' => [
                'name' => 'Upgrade or stabilization',
                'badge' => 'One-off stage',
                'price' => 'from $1,600',
                'price_sub' => 'Fixed scope',
                'timeline' => 'Typically 1–3 weeks',
                'desc' => 'Laravel, Symfony or PHP upgrades, legacy project stabilization or speeding up slow pages.',
                'features' => [
                    'Dependency, PHP version and critical error review',
                    'Backup verification and test environment setup',
                    'Laravel or Symfony and package compatibility upgrades',
                    'Critical bug fixes and database bottleneck tuning',
                    'Automated tests for key user flows',
                    'Deployment plan with a fast rollback option',
                    'Setup and deployment documentation',
                    'Bug fixes for 2 weeks after release',
                ],
                'cta' => 'Estimate an upgrade',
            ],
            'retainer' => [
                'name' => 'Ongoing PHP / Laravel support',
                'badge' => 'Monthly care',
                'price' => 'from $1,400',
                'price_sub' => 'Per month · or from $35/hr',
                'timeline' => 'Monthly',
                'desc' => 'Planned care for a live application: bug fixes, small changes, security patches and backup checks.',
                'features' => [
                    'Bug fixes and ongoing small improvements',
                    'Regular PHP and dependency security updates',
                    'Backup, queue and error-log checks',
                    'Uptime and response-time monitoring',
                    'Direct Telegram or Slack channel',
                    'Agreed monthly hours package',
                ],
                'cta' => 'Discuss support',
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
        'bio' => "I work with live PHP applications in Laravel and Symfony: upgrading older versions, stabilizing undocumented codebases and speeding up slow database queries.\n\nI start with facts from logs, code and server config, then propose a clear plan with explicit risks.",
        'more_links' => 'Videos and blog',
        'facts' => [
            '8+ years of commercial development',
            'Laravel, Symfony, PHP 7/8, PostgreSQL, MySQL, Docker',
            'Staged upgrades with tests and a rollback plan',
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
        'title' => 'Common questions about PHP support & upgrades',
        'subtitle' => 'Handovers, old versions, urgent bugs and billing.',
        'items' => [
            'q1' => [
                'q' => 'The previous developer left and there is no documentation. Can you take over?',
                'a' => 'Yes. We inventory what remains (code, server, database, credentials), create a backup, bring up a test copy and restore control step by step.',
            ],
            'q2' => [
                'q' => 'How do you upgrade an older Laravel (6, 7, 8, 9) app?',
                'a' => 'We upgrade incrementally on a separate branch and test server, verify package compatibility and add tests for critical flows. Production cutover is planned for a low-traffic window with a rollback plan.',
            ],
            'q3' => [
                'q' => 'Do you take small one-off tasks of a few hours?',
                'a' => 'Yes, smaller tasks are billed from $35/hr after a quick look at the codebase and scope.',
            ],
            'q4' => [
                'q' => 'Can you help if pages are slow or crash under load?',
                'a' => 'Yes. We profile slow SQL queries, indexes, N+1 issues, queues and Redis caching and record measurable before/after metrics.',
            ],
            'q5' => [
                'q' => 'What do you need to get started?',
                'a' => 'A short description of the problem and your current PHP and framework version. Read-only repository access (under NDA if needed) helps us give an accurate estimate.',
            ],
            'q6' => [
                'q' => 'How does payment work?',
                'a' => 'Fixed stage pricing for upgrades or stabilization, or a monthly hours package / hourly invoicing.',
            ],
            'q7' => [
                'q' => 'Which countries do you work with?',
                'a' => 'We work remotely with companies in Ukraine, Poland, the EU, the UK, the US and Canada.',
            ],
        ],
    ],

    'contact' => [
        'badge' => 'Get in touch',
        'title' => 'Tell us what needs fixing or upgrading',
        'subtitle' => 'Describe your project’s current state and main issue. We will suggest a safe plan and an estimate.',
        'telegram_cta' => 'Message on Telegram',
        'telegram_hint' => 'We usually reply the same day',
        'email_cta' => 'Send an email',
        'form' => [
            'project_name' => 'Your name or company',
            'project_name_placeholder' => 'Alex / Company Ltd',
            'contact' => 'Telegram or email',
            'contact_placeholder' => '@username or name@company.com',
            'stage' => 'What you need now',
            'not_specified' => 'Not specified',
            'stage_options' => [
                'idea' => 'Laravel, Symfony or PHP upgrade',
                'spec' => 'Bug fixes, speed tuning or legacy stabilization',
                'rewrite' => 'Ongoing monthly support',
            ],
            'budget' => 'Preferred format',
            'budget_options' => [
                'sprint' => 'From $1,600 (upgrade / stabilization)',
                'custom' => 'Ad-hoc task (from $35/hr)',
                'retainer' => 'Monthly support (from $1,400/mo)',
            ],
            'description' => 'Project & issue description',
            'description_placeholder' => 'Which stack and version are you using, and what is failing or needs upgrading?',
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
        'tagline' => 'PHP, Laravel and Symfony support & upgrades',
        'all_rights_reserved' => 'All rights reserved',
        'location' => 'Stęszew near Poznań, Wielkopolska, Poland.',
    ],
];
