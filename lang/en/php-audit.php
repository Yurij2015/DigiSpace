<?php

return [
    'seo' => [
        'title' => 'PHP, Laravel & Symfony Code Audit | DigiSpace',
        'description' => 'Manual PHP, Laravel and Symfony code audit: access control, payments, slow database queries and a prioritized report with file and line references. From $1,000 net.',
    ],

    'nav' => [
        'proofs' => 'Projects',
        'guarantees' => 'How we work',
        'pricing' => 'Pricing',
        'faq' => 'FAQ',
        'cta' => 'Discuss an audit',
        'skip' => 'Skip to content',
        'theme_toggle' => 'Switch light / dark theme',
    ],

    'hero' => [
        'badge' => 'Technical audit · PHP / Laravel / Symfony',
        'title' => 'PHP code audit: file-level findings and a clear fix plan',
        'subtitle' => 'We inspect your PHP, Laravel or Symfony codebase to find root causes of bugs, access-control gaps, payment issues and slow database queries. You receive a prioritized report with file and line references that your team can act on.',
        'subtitle_short' => 'Manual review of PHP, Laravel and Symfony code: data access, payments, database queries and tests. Report with code links in 3–7 business days.',
        'cta_primary' => 'Discuss audit scope',
        'status' => 'Available for code audits',
        'metric_labels' => [
            'price' => 'Pricing',
            'timeline' => 'Turnaround',
            'ownership' => 'Deliverable',
        ],
        'metrics' => [
            'price' => 'From $1,000 net',
            'timeline' => 'Report in 3–7 business days',
            'ownership' => 'File, line, impact & fix plan',
        ],
    ],

    'proofs' => [
        'badge' => 'Our projects',
        'title' => 'Production engineering experience',
        'subtitle' => 'We build and maintain live PHP systems ourselves, so our audits focus on defects that affect data, payments and stability.',
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
                'tagline' => 'Architecture with response-time tracking, queues and isolated workers',
                'stack' => ['Laravel Octane', 'PostgreSQL', 'Redis', 'PHPStan', 'Go'],
                'live_url' => 'https://digipulse.cloud',
            ],
            'vetspace' => [
                'badge' => 'Multi-tenant B2B platform',
                'name' => 'VetSpace & VetCard',
                'screens' => [
                    ['file' => 'vetspace-clinic-month', 'caption' => 'Monthly calendar: daily appointment counts for each doctor (demo data)'],
                    ['file' => 'vetspace-clinic-calendar', 'caption' => 'Appointment calendar: filters by branch and doctor (demo data)'],
                    ['file' => 'vetspace-admin-plans', 'caption' => 'Filament admin panel: subscription plans synced with Stripe'],
                    ['file' => 'vetspace-swagger-appointments', 'caption' => 'API documentation: requests for managing appointments'],
                ],
                'tagline' => 'Tenant data isolation, access controls, Stripe billing and automated tests',
                'stack' => ['Laravel', 'Multi-tenancy', 'Stripe', 'PHPUnit', 'PostgreSQL'],
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
        'title' => 'What we inspect during a PHP code audit',
        'subtitle' => 'We focus review time on the modules that matter most to your business.',
        'pillars' => [
            'multitenancy' => [
                'title' => 'Security, auth and data access controls',
            ],
            'billing' => [
                'title' => 'Payments, orders and webhook handling',
            ],
            'workers' => [
                'title' => 'Database queries, indexes and N+1 bottlenecks',
            ],
            'admin' => [
                'title' => 'Queues, background jobs and race conditions',
            ],
            'ai' => [
                'title' => 'Dependencies, PHP/framework versions and test coverage',
            ],
            'devops' => [
                'title' => 'Deployment pipeline, backups and configuration',
            ],
        ],
    ],

    'guarantees' => [
        'badge' => 'Deliverable format',
        'title' => 'What you receive after the audit',
        'subtitle' => 'Evidence-backed findings and explicit review boundaries that your team can turn directly into tickets.',
        'items' => [
            'staging' => [
                'badge' => 'Specifics',
                'title' => 'Exact file and line references',
                'desc' => 'Each finding includes the repository path, an explanation of its impact and a recommended fix.',
            ],
            'testing' => [
                'badge' => 'Priorities',
                'title' => 'Confirmed defects separate from advice',
                'desc' => 'We separate verified bugs and security risks from structural refactoring suggestions so your team sees real priorities.',
            ],
            'ownership' => [
                'badge' => 'Confidentiality',
                'title' => 'Protected by NDA',
                'desc' => 'We sign an NDA before accessing your repository; read-only access is enough for most reviews.',
            ],
            'direct' => [
                'badge' => 'Walkthrough',
                'title' => 'Live report review call',
                'desc' => 'We go through the findings with you or your team, answer questions and help plan the next steps.',
            ],
        ],
    ],

    'process' => [
        'title' => 'How the audit works',
        'subtitle' => 'From agreeing on focus to a completed report in 3–7 business days depending on codebase size.',
        'sprints' => [
            's1' => [
                'name' => 'Scope and focus',
                'duration' => 'Day 1',
                'desc' => 'We agree on the main questions: data access, payments, speed, maintainability or pre-release review.',
            ],
            's2' => [
                'name' => 'Code and dependency review',
                'duration' => 'Days 2–4',
                'desc' => 'We read code, migrations, database queries and tests; where a test environment exists, we reproduce failing flows.',
            ],
            's3' => [
                'name' => 'Prioritized report',
                'duration' => 'Days 5–6',
                'desc' => 'We document reviewed areas, separate confirmed defects from assumptions, and rank fixes by impact.',
            ],
            's4' => [
                'name' => 'Walkthrough and next steps',
                'duration' => 'Day 7',
                'desc' => 'We review the report on a call; optionally we can agree on a separate stage to fix critical issues.',
            ],
        ],
    ],

    'pricing' => [
        'net_label' => 'net',
        'vat_note' => 'All prices are net. As a Polish VAT payer, we add VAT under Polish law (23% for clients in Poland).',
        'comparison_note' => 'An audit gives you an objective picture of your codebase before spending on a rewrite or switching contractors.',
        'badge' => 'Pricing',
        'title' => 'Two PHP audit formats',
        'subtitle' => 'A standalone audit report for your team, or an audit paired with fixing agreed critical issues.',
        'plans' => [
            'mvp' => [
                'name' => 'PHP / Laravel / Symfony audit',
                'badge' => 'Report + action plan',
                'price' => 'from $1,000',
                'price_sub' => 'Fixed scope',
                'timeline' => '3–7 business days',
                'desc' => 'Review of selected modules or key parts of the application with a prioritized report and walkthrough call.',
                'features' => [
                    'Architecture, security and access-control review',
                    'Inspection of critical modules (payments, orders, APIs)',
                    'Slow SQL query and bottleneck check',
                    'Dependency, PHP version and test suite assessment',
                    'Report with exact file and line references',
                    'Confirmed defects separated from advice',
                    'Prioritized action plan with rough fix estimates',
                    'Live walkthrough call with your team',
                ],
                'cta' => 'Discuss an audit',
            ],
            'retainer' => [
                'name' => 'Audit + critical fixes',
                'badge' => 'Report and fixes',
                'price' => 'from $2,200',
                'price_sub' => 'Fixed scope',
                'timeline' => 'Typically 2–3 weeks',
                'desc' => 'Code audit plus hands-on fixes for agreed high-priority security, speed and stability issues.',
                'features' => [
                    'Everything in the PHP / Laravel / Symfony audit',
                    'Fixes for agreed critical bugs and gaps',
                    'Speeding up the slowest database queries',
                    'Automated tests covering the fixed scenarios',
                    'Pull requests in your repository',
                    'Support during production release',
                ],
                'cta' => 'Discuss audit and fixes',
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
        'badge' => 'Who performs the audit',
        'name' => 'Yurii Mokryi',
        'role' => 'Founder of DigiSpace · Solutions Architect & Lead Engineer',
        'bio' => "I conduct every audit myself: reading the actual code, checking access control, payment flows and database queries rather than forwarding automated scanner dumps.\n\nIn the report, confirmed defects are clearly separated from assumptions and refactoring advice.",
        'more_links' => 'Videos and blog',
        'facts' => [
            '8+ years of commercial development',
            'Manual review of business logic and code',
            'Laravel, Symfony, PostgreSQL, MySQL, security & payments',
            'Under NDA for clients in Ukraine, the EU and the US',
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
        'title' => 'Common questions about PHP code audits',
        'subtitle' => 'Access, NDA, report format and next steps.',
        'items' => [
            'q1' => [
                'q' => 'When is a code audit most useful?',
                'a' => 'When releases keep introducing bugs, pages are slow, you are switching contractors, planning a major upgrade or checking technical risk before an investment.',
            ],
            'q2' => [
                'q' => 'What access do you need?',
                'a' => 'Read-only access to the Git repository is usually enough. For performance checks, staging access or an anonymized DB schema helps as well.',
            ],
            'q3' => [
                'q' => 'Do you sign an NDA?',
                'a' => 'Yes, we sign an NDA before receiving any repository access or documentation.',
            ],
            'q4' => [
                'q' => 'How is this different from automated scanners?',
                'a' => 'Static analysis is only a helper. The main value comes from manually checking business logic: permissions, payments, transactions, architecture and database queries.',
            ],
            'q5' => [
                'q' => 'Can our own team fix the issues using your report?',
                'a' => 'Yes, the report is structured as a clear engineering list: file, line, issue description, impact and recommended fix.',
            ],
            'q6' => [
                'q' => 'How does payment work?',
                'a' => '50% upfront before starting and 50% upon delivering the report and walkthrough call, with an official invoice.',
            ],
            'q7' => [
                'q' => 'Which countries do you work with?',
                'a' => 'We work remotely with companies in Ukraine, Poland, the EU, the UK, the US and Canada.',
            ],
        ],
    ],

    'contact' => [
        'badge' => 'Get in touch',
        'title' => 'Discuss a PHP code audit',
        'subtitle' => 'Tell us about your application and the questions the review should answer. We will agree on scope, turnaround and price.',
        'telegram_cta' => 'Message on Telegram',
        'telegram_hint' => 'We usually reply the same day',
        'email_cta' => 'Send an email',
        'form' => [
            'project_name' => 'Your name or company',
            'project_name_placeholder' => 'Alex / Company Ltd',
            'contact' => 'Telegram or email',
            'contact_placeholder' => '@username or name@company.com',
            'stage' => 'Main audit goal',
            'not_specified' => 'Not specified',
            'stage_options' => [
                'idea' => 'General technical audit / contractor check',
                'spec' => 'Security, access control or payment issues',
                'rewrite' => 'Slow performance, bugs or scaling preparation',
            ],
            'budget' => 'Audit format',
            'budget_options' => [
                'sprint' => 'Audit & report only (from $1,000)',
                'custom' => 'Audit + critical fixes (from $2,200)',
                'retainer' => 'Audit followed by ongoing support',
            ],
            'description' => 'Short project description',
            'description_placeholder' => 'Which framework (Laravel / Symfony / PHP) and what questions should the audit answer?',
            'submit' => 'Discuss an audit',
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
        'tagline' => 'PHP, Laravel and Symfony code audits',
        'all_rights_reserved' => 'All rights reserved',
        'location' => 'Stęszew near Poznań, Wielkopolska, Poland.',
    ],
];
