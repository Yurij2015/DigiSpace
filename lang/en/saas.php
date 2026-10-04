<?php

return [
    'seo' => [
        'title' => 'SaaS MVP Development in Poznań | DigiSpace',
        'description' => 'SaaS MVP development to test your idea and launch your product. From $4,800 net, typically 6–8 weeks. Working with clients across Poland and the EU.',
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
        'title' => 'SaaS MVP development, from idea to launch',
        'subtitle' => 'We build the first version of your SaaS so you can test your idea with real users. Together, we define the features, agree on a budget and timeline, and get your product ready to launch.',
        'subtitle_short' => 'We build your SaaS MVP so you can test your idea with real users. We agree on features, budget and timeline before development starts.',
        'cta_primary' => 'Get a cost and timeline estimate',
        'status' => 'Taking on new projects',
        'metric_labels' => [
            'price' => 'Budget',
            'timeline' => 'Timeline',
            'ownership' => 'Transparency',
        ],
        'metrics' => [
            'price' => 'MVP from $4,800 net',
            'timeline' => 'Typically 6–8 weeks',
            'ownership' => 'You see progress at every stage',
        ],
    ],

    'proofs' => [
        'badge' => 'Our projects',
        'title' => 'Products we built and run ourselves',
        'subtitle' => 'Explore our products, see what they do and learn which technologies we use.',
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
                'tagline' => 'Website uptime monitoring with incident alerts',
                'stack' => ['Laravel Octane', 'Go', 'Redis', 'Filament', 'PostgreSQL', 'MCP'],
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
                'tagline' => 'Platform for veterinary clinics and pet owners',
                'stack' => ['Laravel API', 'Nuxt SSR', 'Multi-tenancy', 'Stripe Cashier', 'Tailwind CSS', 'PostgreSQL'],
                'live_url' => 'https://vetspace.pro',
            ],
            // Not a public product: one line under the showcase cards, linking the descriptive repository.
            'netpostpanel' => [
                'name' => 'NetPostPanel',
                'mention' => 'We also built :name, an internal tool for AI-assisted source research and drafting: RAG over our own sources with Qdrant and Langfuse. The AI generation and translation on this site run on it.',
                'live_url' => 'https://github.com/Yurij2015/net-post-panel-overview',
                'link_label' => 'Read the overview on GitHub',
            ],
        ],
    ],

    'engine' => [
        'title' => 'What we can build into your SaaS',
        'subtitle' => 'At the start, we decide what the first version needs and what can be added later.',
        'pillars' => [
            'multitenancy' => [
                'title' => 'Data isolation between companies',
            ],
            'billing' => [
                'title' => 'Stripe subscriptions',
            ],
            'workers' => [
                'title' => 'Background job processing',
            ],
            'admin' => [
                'title' => 'Admin panel (Filament)',
            ],
            'ai' => [
                'title' => 'AI features and search across your data',
            ],
            'devops' => [
                'title' => 'Docker deployment',
            ],
        ],
    ],

    'guarantees' => [
        'badge' => 'How we work',
        'title' => 'What you can count on',
        'subtitle' => 'Access to work in progress, feature testing and direct communication.',
        'items' => [
            'staging' => [
                'badge' => 'Product preview',
                'title' => 'Try your product before launch',
                'desc' => 'We provide access to a test environment during development. Try completed features and let us know what needs further work.',
            ],
            'testing' => [
                'badge' => 'Tests',
                'title' => 'Automated tests',
                'desc' => 'Automated tests check business logic and key user actions such as sign-up, sign-in and payment. They help catch errors before updates are released.',
            ],
            'ownership' => [
                'badge' => 'Collaboration',
                'title' => 'Access to code during development',
                'desc' => 'We work in your GitHub repository or give you access to ours during development. We agree on the setup at the start.',
            ],
            'direct' => [
                'badge' => 'Direct contact',
                'title' => 'You talk to the developer',
                'desc' => 'You discuss requirements and technical decisions directly with the developer building your product.',
            ],
        ],
    ],

    'process' => [
        'title' => 'Four stages to launch',
        'subtitle' => 'Below is an example eight-week plan. The duration of each stage depends on the agreed scope.',
        'sprints' => [
            's1' => [
                'name' => 'Architecture and database',
                'duration' => 'Weeks 1–2',
                'desc' => 'We design the application structure and database.',
            ],
            's2' => [
                'name' => 'Core features and payments',
                'duration' => 'Weeks 3–4',
                'desc' => 'We build the core features and integrate payments where needed.',
            ],
            's3' => [
                'name' => 'User area and admin panel',
                'duration' => 'Weeks 5–6',
                'desc' => 'We build the user dashboard and tools for managing the product.',
            ],
            's4' => [
                'name' => 'Testing and launch',
                'duration' => 'Weeks 7–8',
                'desc' => 'We check the product and its security, then deploy it to the agreed hosting environment.',
            ],
        ],
    ],

    'pricing' => [
        'net_label' => 'net',
        'vat_note' => 'All prices are net. As a Polish VAT payer, we add VAT under Polish law (23% for clients in Poland).',
        'comparison_note' => 'Agencies with large teams and project managers suit enterprise projects. For an MVP, working directly with a senior developer keeps the budget focused on code, not overhead.',
        'badge' => 'Pricing',
        'title' => 'Pricing: two ways to work together',
        'subtitle' => 'Build the first version for an agreed price, or get monthly support and development for an existing product.',
        'plans' => [
            'mvp' => [
                'name' => 'SaaS MVP',
                'badge' => 'For a new product',
                'price' => 'from $4,800',
                'price_sub' => 'Fixed scope',
                'timeline' => 'Typically 6–8 weeks',
                'desc' => 'For launching a first version and testing demand. We agree on the features and final price before work begins.',
                'features' => [
                    'Database design and data access controls',
                    'Stripe subscriptions and payment integration',
                    'User dashboard and Filament admin panel',
                    'Access to a test environment during development',
                    'Automated tests for core features and user actions',
                    'Deployment to the agreed hosting environment',
                    'Access to code and project documentation',
                    'Bug fixes for 2 weeks after launch',
                ],
                'cta' => 'Discuss an MVP',
            ],
            'retainer' => [
                'name' => 'SaaS support and development',
                'badge' => 'For a live product',
                'price' => 'from $2,400',
                'price_sub' => 'Per month',
                'timeline' => 'Monthly',
                'desc' => 'For a product already in use: new features, integrations, bug fixes and performance improvements.',
                'features' => [
                    'Review of architecture, database queries and security',
                    'Backend development and integrations',
                    'Testing under load',
                    'Code review and automated testing and deployment',
                    'Direct Telegram channel',
                    'An agreed number of development hours each week',
                ],
                'cta' => 'Discuss a retainer',
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
        'bio' => "Building a product used to take a full dev team. Today, precise planning, strong AI models and agents take over much of that work: thousands of man-hours turn into hundreds.\n\nI work with proven processes for design, development and fast deployment. You get a reliable product in 6–8 weeks and can move straight to marketing, user acquisition and your first paying customers.",
        'more_links' => 'Videos and blog',
        'facts' => [
            '8+ years of commercial development',
            'Laravel, Symfony, Filament, Vue/Nuxt, Go',
            'My own products: DigiPulse, VetSpace, NetPostPanel',
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
        'title' => 'Common questions about SaaS MVP development',
        'subtitle' => 'Timelines, payments, hosting and working together.',
        'items' => [
            'q1' => [
                'q' => 'What determines the development timeline?',
                'a' => 'The timeline depends on feature complexity, integrations and how clearly the requirements are defined. For the first version, we select the features needed to test the product idea. A typical timeline is 6–8 weeks; we agree on the schedule after discussing the scope.',
            ],
            'q2' => [
                'q' => 'How do you manage access to the code?',
                'a' => 'We work in your GitHub repository or give you access to ours during development. We agree on code handover and hosting for the finished product before work begins.',
            ],
            'q3' => [
                'q' => 'Where will the application run, and how much does hosting cost?',
                'a' => 'We provide a test environment during development. Hosting for the finished product and payment arrangements are agreed separately. Costs depend on the expected load and the services needed.',
            ],
            'q4' => [
                'q' => 'What do you need from me to start?',
                'a' => 'A short description of the problem your product solves, who it is for and how you plan to make money from it. Fill in the form or message us on Telegram. In our first conversation, we discuss the idea, clarify requirements and agree on the next steps.',
            ],
            'q5' => [
                'q' => 'How are infrastructure and code reliability organized?',
                'a' => 'Every change goes through automated tests in a CI/CD pipeline before release, and you see it in the test environment first. The infrastructure is described as code and runs in Docker containers on virtual servers (Proxmox), so environments are identical and easy to rebuild. AI speeds up the work; the tests and the pipeline keep it reliable.',
            ],
            'q6' => [
                'q' => 'How does payment work?',
                'a' => 'Payment is split into four instalments of 25%, due at the start of each stage. Before paying for the next stage, you review the previous stage’s results in the test environment. Payment through an escrow service is also possible.',
            ],
            'q7' => [
                'q' => 'Do you work with companies in Poznań and the surrounding area?',
                'a' => 'Yes. We are based in Stęszew near Poznań. We can arrange in-person meetings with clients in Poznań and the surrounding area. We work remotely with clients in other cities and countries.',
            ],
        ],
    ],

    'contact' => [
        'badge' => 'Get in touch',
        'title' => 'Tell us about your product',
        'subtitle' => 'Describe your idea or what you need help with. We will clarify the requirements and prepare an initial cost and timeline estimate.',
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
                'custom' => '$8,500+ (larger scope)',
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
        'tagline' => 'SaaS and web development',
        'all_rights_reserved' => 'All rights reserved',
        'location' => 'Stęszew near Poznań, Wielkopolska, Poland.',
    ],
];
