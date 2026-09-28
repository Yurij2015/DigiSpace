<?php

return [
    'seo' => [
        'title' => 'SaaS MVP Development in Poznań | DigiSpace',
        'description' => 'SaaS MVP development in 6–8 weeks: multi-tenancy, Stripe subscriptions, background queues and AI integrations. DigiSpace works with clients in Poznań, across Poland and the EU.',
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
        'badge' => 'SaaS development · Poznań',
        'title' => 'Your SaaS MVP, from idea to launch in 6–8 weeks',
        'subtitle' => 'We design and build SaaS products on a solid base: separate data for each client company, Stripe subscriptions, background jobs and AI features where they make sense. You talk directly to the developer who writes the code.',
        'subtitle_short' => 'SaaS products on a solid base: separate data for each client, Stripe subscriptions, background jobs and AI. You talk directly to the developer.',
        'cta_primary' => 'Get a scope and timeline estimate',
        'status' => 'Taking on new projects',
        'metric_labels' => [
            'price' => 'Budget',
            'timeline' => 'Timeline',
            'ownership' => 'Ownership',
        ],
        'metrics' => [
            'price' => 'MVP from $4,800 net',
            'timeline' => '6–8 weeks to launch',
            'ownership' => 'Code and servers are yours',
        ],
    ],

    'proofs' => [
        'badge' => 'Our projects',
        'title' => 'Products we built and run ourselves',
        'subtitle' => 'Each of these systems runs in production. Browse the screenshots or open the product itself.',
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
                    ['file' => 'digipulse-dashboard', 'caption' => 'Dashboard: status, check types, SSL, ping and 30-day uptime of every monitored site (site names blurred)'],
                    ['file' => 'digipulse-history', 'caption' => 'Site history: weekly response time, P95 latency, Apdex score and incidents'],
                ],
                'tagline' => 'Website uptime monitoring with incident alerts',
                'stack' => ['Laravel Octane', 'Go', 'Redis', 'Filament', 'PostgreSQL', 'MCP'],
                'live_url' => 'https://digipulse.cloud',
            ],
            'vetspace' => [
                'badge' => 'Multi-tenant B2B platform',
                'name' => 'VetSpace & VetCard',
                'screens' => [
                    ['file' => 'vetspace-clinic-month', 'caption' => 'Clinic workspace: month view with the number of appointments per doctor for every day (demo data)'],
                    ['file' => 'vetspace-clinic-calendar', 'caption' => 'Clinic workspace: appointment calendar with branch and doctor filters (demo data)'],
                    ['file' => 'vetspace-admin-plans', 'caption' => 'Filament admin panel: subscription plans synced with Stripe'],
                    ['file' => 'vetspace-swagger-appointments', 'caption' => 'REST API documented with OpenAPI (Swagger): appointment endpoints of the core API'],
                ],
                'tagline' => 'Platform for veterinary clinics and pet owners',
                'stack' => ['Laravel API', 'Nuxt SSR', 'Multi-tenancy', 'Stripe Cashier', 'Tailwind CSS', 'PostgreSQL'],
                'live_url' => 'https://vetspace.pro',
            ],
            'netpostpanel' => [
                'badge' => 'AI & RAG platform',
                'name' => 'NetPostPanel',
                'screens' => [
                    ['file' => 'netpostpanel-workbench', 'caption' => 'Workbench: content type, prompt and source research in a single flow'],
                    ['file' => 'netpostpanel-autopilot', 'caption' => 'Auto Pilot: daily scheduled generation from custom topics and sources'],
                ],
                'tagline' => 'Content preparation with AI: source research, drafts, semantic search',
                'stack' => ['Laravel', 'RAG', 'Qdrant', 'Langfuse', 'Horizon', 'LLM API'],
                'live_url' => 'https://github.com/Yurij2015/net-post-panel-overview',
                // Not a public product: link the descriptive repository, as the portfolio does.
                'link_label' => 'Read the overview on GitHub',
            ],
        ],
    ],

    'engine' => [
        'title' => 'Building blocks of a typical SaaS MVP',
        'subtitle' => 'Which of these your product needs is agreed at the start. We don’t build what you won’t use.',
        'pillars' => [
            'multitenancy' => [
                'title' => 'Multi-tenancy',
            ],
            'billing' => [
                'title' => 'Stripe subscriptions',
            ],
            'workers' => [
                'title' => 'Background jobs',
            ],
            'admin' => [
                'title' => 'Admin panel (Filament)',
            ],
            'ai' => [
                'title' => 'AI features and RAG',
            ],
            'devops' => [
                'title' => 'Docker and deployment',
            ],
        ],
    ],

    'guarantees' => [
        'badge' => 'How we work',
        'title' => 'What you can count on',
        'subtitle' => 'Four rules we follow on every project, and the launch plan.',
        'items' => [
            'staging' => [
                'badge' => 'First week',
                'title' => 'A test server from the first week',
                'desc' => 'During the first week you get a password-protected test server. Every change that passes the automated tests is deployed there automatically (GitHub Actions), so you see the product itself rather than status reports.',
            ],
            'testing' => [
                'badge' => 'Tests',
                'title' => 'Automated tests',
                'desc' => 'Unit tests cover business logic and billing; Playwright tests go through sign-up, onboarding and payment the way a user would. They run on every push, so regressions get caught before release.',
            ],
            'ownership' => [
                'badge' => 'Ownership',
                'title' => 'Code and infrastructure belong to you',
                'desc' => 'Commits go to your private GitHub or GitLab repository from day one, and the application runs on your cloud account. No proprietary licences.',
            ],
            'direct' => [
                'badge' => 'Direct contact',
                'title' => 'You talk to the developer',
                'desc' => 'No project managers in between: you discuss tasks directly with the senior full-stack developer who writes the code.',
            ],
        ],
    ],

    'process' => [
        'title' => 'Four stages to launch',
        'subtitle' => 'Each stage takes up to two weeks and ends with a demo on the test server. With a smaller scope the stages are shorter, and launch can happen in 6 weeks.',
        'sprints' => [
            's1' => [
                'name' => 'Architecture and foundation',
                'duration' => 'Weeks 1–2',
                'desc' => 'An architecture with room for the product to grow.',
            ],
            's2' => [
                'name' => 'Core features and payments',
                'duration' => 'Weeks 3–4',
                'desc' => 'The main thing your product does, plus subscriptions.',
            ],
            's3' => [
                'name' => 'User area and admin panel',
                'duration' => 'Weeks 5–6',
                'desc' => 'What your customers and your team will work in.',
            ],
            's4' => [
                'name' => 'Testing and launch',
                'duration' => 'Weeks 7–8',
                'desc' => 'End-to-end tests, security checks and production release.',
            ],
        ],
    ],

    'pricing' => [
        'net_label' => 'net',
        'vat_note' => 'All prices are net. As a Polish VAT payer, we add VAT under Polish law (23% for clients in Poland).',
        'comparison_note' => 'An agency with a team and a project manager suits large projects. For an MVP, one senior developer is usually enough — which is why the budget is lower.',
        'badge' => 'Pricing',
        'title' => 'Two ways to work together',
        'subtitle' => 'A fixed scope and price to launch an MVP, or a monthly arrangement for a product that is already live.',
        'plans' => [
            'mvp' => [
                'name' => 'SaaS MVP',
                'badge' => 'For a new product',
                'price' => 'from $4,800',
                'price_sub' => '≈ 19,000 PLN · fixed scope',
                'timeline' => '6–8 weeks',
                'desc' => 'For founders who want to launch, test demand and get their first paying customers.',
                'features' => [
                    'Database design and data separation between companies',
                    'Stripe subscriptions: checkout, customer portal, invoices',
                    'User dashboard and Filament admin panel',
                    'Test server from the first week',
                    'Unit and Playwright tests',
                    'Docker deployment to your cloud account',
                    'Full handover of code and documentation',
                    '2 weeks of post-launch bug fixes included',
                ],
                'cta' => 'Discuss an MVP',
            ],
            'retainer' => [
                'name' => 'Senior support',
                'badge' => 'For a live product',
                'price' => 'from $2,400',
                'price_sub' => '≈ 9,500 PLN · per month',
                'timeline' => 'Monthly',
                'desc' => 'For a live SaaS that needs senior technical help: new features, refactoring, AI integrations, scaling.',
                'features' => [
                    'Architecture, SQL and security review',
                    'Complex backend work (AI, RAG, Go workers)',
                    'Load testing and preparation for growth',
                    'Code review and CI/CD improvements',
                    'Direct Telegram channel',
                    'A reserved number of hours per week',
                ],
                'cta' => 'Discuss a retainer',
            ],
        ],
    ],

    'social_proof' => [
        'badge' => 'Client feedback',
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
        'role' => 'Founder of DigiSpace · Senior full-stack developer',
        'bio' => 'I design and build web products end to end: from the database and payments to deployment and support. My own SaaS products run in production, so I know the work doesn’t end at launch.',
        'more_links' => 'Videos and blog',
        'facts' => [
            '8+ years of commercial development',
            'Laravel, Symfony, Filament, Vue/Nuxt, Go',
            'Own SaaS in production: DigiPulse, VetSpace, NetPostPanel',
            'Based in Stęszew near Poznań, Poland',
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
        'title' => 'Common questions',
        'subtitle' => 'Timelines, payments, hosting and working together.',
        'items' => [
            'q1' => [
                'q' => 'Why 6–8 weeks?',
                'a' => 'The first version covers the 3–5 features that solve your users’ main problem and that they will pay for. Sign-in, multi-tenancy and Stripe billing are built from ready, tested modules rather than from scratch. The typical plan is four two-week stages; with a smaller scope the stages are shorter and launch can happen in 6 weeks. If the scope is larger, we say so at the estimate stage.',
            ],
            'q2' => [
                'q' => 'Who owns the code?',
                'a' => 'You do. All work is committed to your private GitHub or GitLab repository from the first day. Code, accounts and access stay with you.',
            ],
            'q3' => [
                'q' => 'Where will the application run, and how much does hosting cost?',
                'a' => 'In Docker on your own cloud account (Hetzner, AWS or DigitalOcean). For an MVP, a VPS for about $15–35 a month is usually enough; we will size it for your expected load.',
            ],
            'q4' => [
                'q' => 'What do you need from me to start?',
                'a' => 'A short description: what problem the product solves, for whom, and how it will make money. Fill in the form on this page or message us on Telegram; then, on a short call online or at a meeting in Poznań, we agree on the MVP scope and put together a technical brief.',
            ],
            'q6' => [
                'q' => 'How does payment work?',
                'a' => 'Payment is split across the four stages: 25% at the start of each; escrow is also possible. You see the result of each stage on the test server before paying for the next one.',
            ],
            'q7' => [
                'q' => 'Do you work with companies in Poznań and the surrounding area?',
                'a' => 'Yes. We are in Stęszew, just outside Poznań, so with clients from Poznań and Poznań County — Luboń, Komorniki, Dopiewo, Mosina, Puszczykowo, Swarzędz, Suchy Las, Tarnowo Podgórne — we can meet in person: at your office or in Poznań, for example for the kick-off or before the launch. Clients from the rest of Poland and abroad work with us remotely, with the same process.',
            ],
        ],
    ],

    'contact' => [
        'badge' => 'Get in touch',
        'title' => 'Tell us about your product',
        'subtitle' => 'Fill in the short form or message us on Telegram, and we will reply with a scope and timeline estimate.',
        'telegram_cta' => 'Message on Telegram',
        'telegram_hint' => 'We usually reply the same day',
        'email_cta' => 'Send an email',
        'form' => [
            'project_name' => 'Your name or company',
            'project_name_placeholder' => 'Alex / Startup Inc.',
            'contact' => 'Telegram or email',
            'contact_placeholder' => '@username or name@company.com',
            'stage' => 'Project stage',
            'not_specified' => 'Not specified',
            'stage_options' => [
                'idea' => 'Idea',
                'spec' => 'I have a brief or mock-ups',
                'rewrite' => 'Live product that needs changes or scaling',
            ],
            'budget' => 'Budget',
            'budget_options' => [
                'sprint' => '$4,800 – $8,500 (MVP)',
                'custom' => '$8,500+ (complex project, AI)',
                'retainer' => 'Monthly arrangement',
            ],
            'description' => 'Short product description',
            'description_placeholder' => 'What will the product do, and who is it for?',
            'submit' => 'Get an estimate',
            'response_time' => 'We reply within one business day.',
            'errors_title' => 'Please check the form:',
            'validation' => [
                'required' => 'Please fill in “:attribute”.',
                'max' => '“:attribute” is too long (up to :max characters).',
                'invalid' => 'Please choose a value from the list for “:attribute”.',
            ],
            'recaptcha_failed' => 'We could not confirm the form was sent by a person. Please try again or message us on Telegram.',
            'recaptcha_notice' => 'This form is protected by Google reCAPTCHA:',
            'recaptcha_privacy' => 'Privacy Policy',
            'recaptcha_terms' => 'Terms of Service',
            'privacy_notice' => 'The data controller is Yurii Mokryi JDG (DigiSpace). We use the data from this form only to reply to your inquiry.',
            'success_title' => 'Thank you!',
            'success_message' => 'We have received your message and will reply within one business day with questions or a first estimate.',
        ],
    ],

    'footer' => [
        'legal' => 'Yurii Mokryi JDG · NIP 7773404080 · REGON 524949632',
        'privacy_policy' => 'Privacy policy',
        'tagline' => 'SaaS and web development',
        'all_rights_reserved' => 'All rights reserved',
        'location' => 'Stęszew near Poznań, Wielkopolska, Poland.',
    ],
];
