<?php

return [
    'seo' => [
        'title' => 'SaaS MVP Development in Poznań | DigiSpace',
        'description' => 'SaaS MVP development in 6–8 weeks: multi-tenancy, Stripe subscriptions, background queues and AI integrations. DigiSpace works from Poznań with clients in Wielkopolska, across Poland and the EU.',
    ],

    'nav' => [
        'proofs' => 'Projects',
        'engine' => 'What’s included',
        'guarantees' => 'How we work',
        'process' => 'Plan',
        'pricing' => 'Pricing',
        'faq' => 'FAQ',
        'cta' => 'Discuss a project',
        'location' => 'Poznań · Wielkopolska',
        'theme_toggle' => 'Switch light / dark theme',
    ],

    'hero' => [
        'badge' => 'SaaS development · Poznań',
        'title' => 'Your SaaS MVP, from idea to launch in 6–8 weeks',
        'subtitle' => 'We design and build SaaS products on a solid base: separate data for each client company, Stripe subscriptions, background jobs and AI features where they make sense. The code is written by the developer you talk to, with no middlemen in between. We are based in Poznań and work with clients in Wielkopolska, across Poland and remotely.',
        'cta_primary' => 'Get a scope and timeline estimate',
        'cta_secondary' => 'See our projects',
        'status' => 'Taking on new projects',
        'metric_labels' => [
            'timeline' => 'Timeline',
            'ownership' => 'Ownership',
            'staging' => 'Progress',
        ],
        'metrics' => [
            'timeline' => '6–8 weeks to launch',
            'ownership' => 'Code and servers are yours',
            'staging' => 'Test server in the first week',
        ],
    ],

    'proofs' => [
        'badge' => 'Our projects',
        'title' => 'Products we built and run ourselves',
        'subtitle' => 'Each of these systems is live. Open them and see how they work.',
        'view_live' => 'Open the product',
        'projects' => [
            'digipulse' => [
                'badge' => 'Uptime monitoring',
                'name' => 'DigiPulse',
                'tagline' => 'Website uptime monitoring with incident alerts',
                'desc' => 'Laravel Octane and Filament handle scheduling, Redis passes checks to workers written in Go, and alerts go out through Telegram and email. It also has an MCP server, so AI assistants can read monitoring data.',
                'stack' => ['Laravel Octane', 'Go', 'Redis', 'Filament', 'PostgreSQL', 'MCP'],
                'live_url' => 'https://digipulse.cloud',
            ],
            'vetspace' => [
                'badge' => 'Multi-tenant B2B platform',
                'name' => 'VetSpace & VetCard',
                'tagline' => 'Platform for veterinary clinics and pet owners',
                'desc' => 'Every clinic has its own isolated data, its own subdomain or domain, online booking, a staff area and a Stripe subscription (Laravel Cashier). The Nuxt frontend renders pages on the server, which helps clinic pages load fast and get indexed by search engines.',
                'stack' => ['Laravel API', 'Nuxt SSR', 'Multi-tenancy', 'Stripe Cashier', 'Tailwind CSS', 'PostgreSQL'],
                'live_url' => 'https://vetspace.pro',
                'mock' => [
                    'caption' => 'Clinic workspace',
                    'points' => [
                        'Clinic data is isolated from other clinics',
                        'Own subdomain or custom domain',
                        'Subscription billed through Stripe',
                    ],
                ],
            ],
            'netpostpanel' => [
                'badge' => 'AI & RAG platform',
                'name' => 'NetPostPanel',
                'tagline' => 'Content preparation with AI: source research, drafts, semantic search',
                'desc' => 'A RAG pipeline: source research, web scraping, LLM-assisted drafting and vector embeddings. Qdrant handles semantic search, Langfuse tracks LLM cost and latency, and Laravel Horizon runs the queues, including scheduled automatic runs.',
                'stack' => ['Laravel', 'RAG', 'Qdrant', 'Langfuse', 'Horizon', 'LLM API'],
                'live_url' => 'https://net-post-panel.digispace.pro',
            ],
        ],
    ],

    'engine' => [
        'badge' => 'What’s included',
        'title' => 'Building blocks of a typical SaaS MVP',
        'subtitle' => 'Which of these your product needs is agreed at the start. We don’t build what you won’t use.',
        'pillars' => [
            'multitenancy' => [
                'title' => 'Multi-tenancy',
                'desc' => 'Each client company sees only its own data: a separate database or a shared one scoped by tenant. Custom domains and branding when needed.',
                'tag' => 'Data isolation',
            ],
            'billing' => [
                'title' => 'Stripe subscriptions',
                'desc' => 'Stripe Checkout, a customer portal for cards and plans, webhook handling, monthly and annual plans, invoices.',
                'tag' => 'Payments',
            ],
            'workers' => [
                'title' => 'Background jobs',
                'desc' => 'Slow work (PDFs, emails, scraping, AI requests) runs in queues so the interface stays responsive. Go workers are used where throughput actually matters.',
                'tag' => 'Performance',
            ],
            'admin' => [
                'title' => 'Admin panel (Filament)',
                'desc' => 'Manage users, companies and subscriptions, sign in as a user to reproduce issues, activity log and basic revenue figures.',
                'tag' => 'Operations',
            ],
            'ai' => [
                'title' => 'AI features and RAG',
                'desc' => 'Semantic search over your documents (Qdrant), assistants that answer from your own data with sources, and structuring of user input with LLMs.',
                'tag' => 'AI',
            ],
            'devops' => [
                'title' => 'Docker and deployment',
                'desc' => 'Docker Compose, CI/CD on GitHub Actions and deployment to your own Hetzner, AWS or DigitalOcean account. No dependency on us for hosting.',
                'tag' => 'Infrastructure',
            ],
        ],
    ],

    'guarantees' => [
        'badge' => 'How we work',
        'title' => 'What you can count on',
        'subtitle' => 'Four rules we follow on every project.',
        'items' => [
            'staging' => [
                'badge' => 'First week',
                'title' => 'A test server from the first week',
                'desc' => 'During the first week you get a password-protected test server. It updates as work progresses, so you see the product itself rather than status reports.',
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
                'desc' => 'No project managers in between: you discuss tasks directly with the senior full-stack developer who writes the code (8+ years of commercial experience).',
            ],
        ],
    ],

    'comparison' => [
        'badge' => 'Comparison',
        'title' => 'How this differs from a typical agency',
        'subtitle' => 'Agencies suit large teams and long projects. For an MVP, a smaller format is often enough.',
        'headers' => [
            'feature' => 'Aspect',
            'software_house' => 'Typical agency',
            'digispace' => 'DigiSpace',
        ],
        'rows' => [
            'team' => [
                'label' => 'Who writes the code',
                'agency' => 'A team; you communicate through a project manager',
                'us' => 'One senior developer you talk to directly',
            ],
            'timeline' => [
                'label' => 'Time to MVP',
                'agency' => 'Often 3–6 months',
                'us' => '6–8 weeks for an agreed scope',
            ],
            'cost' => [
                'label' => 'MVP budget',
                'agency' => 'Often $15,000+',
                'us' => 'From $4,800 for a fixed scope',
            ],
            'staging' => [
                'label' => 'First working version',
                'agency' => 'Often after the design phase',
                'us' => 'On a test server in the first week',
            ],
            'testing' => [
                'label' => 'Testing',
                'agency' => 'Depends on the team and budget',
                'us' => 'Unit and Playwright tests are part of the scope',
            ],
            'ownership' => [
                'label' => 'Code and servers',
                'agency' => 'Depends on the contract',
                'us' => 'Your repository and your cloud account from day one',
            ],
        ],
    ],

    'process' => [
        'badge' => 'Plan',
        'title' => 'Four two-week sprints to launch',
        'subtitle' => 'Each sprint has a concrete result and ends with a demo on the test server.',
        'sprints' => [
            's1' => [
                'number' => '01',
                'name' => 'Architecture and foundation',
                'duration' => 'Weeks 1–2',
                'desc' => 'A base that won’t need rewriting once the product grows.',
                'deliverables' => [
                    'Database design (PostgreSQL or MySQL)',
                    'Sign-in, roles and data separation between companies',
                    'Test server with automatic deployment (CI/CD)',
                    'Basic interface layout and UI components',
                ],
            ],
            's2' => [
                'number' => '02',
                'name' => 'Core features and payments',
                'duration' => 'Weeks 3–4',
                'desc' => 'The main thing your product does, plus subscriptions.',
                'deliverables' => [
                    'Core product logic',
                    'Stripe Checkout and customer portal (plans and subscriptions)',
                    'Stripe webhook handling (renewals, cancellations, invoices)',
                    'Queues for background jobs',
                ],
            ],
            's3' => [
                'number' => '03',
                'name' => 'User area and admin panel',
                'duration' => 'Weeks 5–6',
                'desc' => 'What your customers and your team will work in.',
                'deliverables' => [
                    'Responsive user dashboard (Tailwind CSS, Vue or Blade)',
                    'Filament admin panel for companies and subscriptions',
                    'AI features or third-party API integrations, if in scope',
                    'Email templates and notifications',
                ],
            ],
            's4' => [
                'number' => '04',
                'name' => 'Testing and launch',
                'duration' => 'Weeks 7–8',
                'desc' => 'End-to-end tests, security checks and production release.',
                'deliverables' => [
                    'Playwright tests for sign-up, onboarding and payment',
                    'Query optimisation, caching and a security review',
                    'Deployment to your cloud (Hetzner, AWS or DigitalOcean)',
                    'Documentation, repository handover and an admin panel walkthrough',
                ],
            ],
        ],
    ],

    'pricing' => [
        'badge' => 'Pricing',
        'title' => 'Two ways to work together',
        'subtitle' => 'A fixed-scope sprint to launch an MVP, or a monthly arrangement for a product that is already live.',
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
                'name' => 'Fractional CTO',
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
            ],
            'linkedin' => [
                'quote' => 'Yurii is a responsible specialist who can work autonomously on a wide range of tasks. He has solid expertise in PHP (Symfony, Laravel) and JavaScript frameworks (Vue.js, Angular) — able to independently investigate complex issues, identify root causes, and implement effective solutions.',
                'source' => 'Recommendation on LinkedIn',
                'url' => 'https://linkedin.com/in/yurii-mokryi',
            ],
        ],
    ],

    'faq' => [
        'badge' => 'FAQ',
        'title' => 'Common questions',
        'subtitle' => 'Timelines, payments, hosting and working together.',
        'items' => [
            'q1' => [
                'q' => 'Why 6–8 weeks?',
                'a' => 'The first version covers the 3–5 features that solve your users’ main problem and that they will pay for. Sign-in, multi-tenancy and Stripe billing are built from ready, tested modules rather than from scratch. If the scope is larger, we say so at the estimate stage.',
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
                'a' => 'A short description: what problem the product solves, for whom, and how it will make money. On a 30-minute call we agree on the MVP scope and put together a technical brief.',
            ],
            'q5' => [
                'q' => 'How do you reduce the risk of production bugs?',
                'a' => 'Unit tests cover business logic and billing, and Playwright tests go through sign-up, onboarding and Stripe payment before every release. That does not rule out bugs, but it catches regressions before users do.',
            ],
            'q6' => [
                'q' => 'How does payment work?',
                'a' => 'Payment is split by sprint, usually 25% at the start of each two-week sprint, or through escrow. You pay for results you have already checked on the test server.',
            ],
            'q7' => [
                'q' => 'Do you work with companies in Poznań and Wielkopolska?',
                'a' => 'Yes. We are based in Poznań, so for clients from Poznań and the surrounding area we can meet in person, for example for the kick-off or the launch. Clients from the rest of Poland and abroad work with us remotely, with the same process.',
            ],
        ],
    ],

    'contact' => [
        'badge' => 'Get in touch',
        'title' => 'Tell us about your product',
        'subtitle' => 'Message us on Telegram, or fill in the short form and we will reply with a scope and timeline estimate.',
        'telegram_cta' => 'Message on Telegram',
        'telegram_hint' => 'We usually reply the same day',
        'email_cta' => 'Send an email',
        'form' => [
            'title' => 'Scope and timeline estimate',
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
            'submit' => 'Send',
            'submitting' => 'Sending…',
            'errors_title' => 'Please check the form:',
            'recaptcha_required' => 'Please confirm that you are not a robot.',
            'success_title' => 'Thank you!',
            'success_message' => 'We have received your message and will reply within one business day with questions or a first estimate.',
        ],
    ],

    'footer' => [
        'tagline' => 'SaaS and web development',
        'all_rights_reserved' => 'All rights reserved',
        'location' => 'Poznań, Wielkopolska, Poland.',
    ],
];
