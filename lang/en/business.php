<?php

// Copy of the business landing (/{locale}/development/business): the same offer, prices and process as
// saas.php, told in the words of a business owner rather than a technical founder. Same key structure.
return [
    'seo' => [
        'title' => 'Custom Software for Businesses in Poznań | DigiSpace',
        'description' => 'Online booking, CRM, client portals and internal systems built around how your business works, typically 6–8 weeks for the first version. Agreed scope and a fixed price. We work with businesses in Poznań, across Poland and the EU.',
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
        'badge' => 'Software for businesses · Poznań',
        'title' => 'Custom software built around your business',
        'subtitle' => 'Online booking, client portals, CRMs or internal tools to replace spreadsheets and manual work. We automate your processes and launch a first version tailored to your business.',
        'subtitle_short' => 'Online booking, a client portal or CRM to replace spreadsheets and manual work. Built around your business.',
        'cta_primary' => 'Get a scope and timeline estimate',
        'status' => 'Taking on new projects',
        'metric_labels' => [
            'price' => 'Budget',
            'timeline' => 'Timeline',
            'ownership' => 'Transparency',
        ],
        'metrics' => [
            'price' => 'From $4,800 net',
            'timeline' => 'Typically 6–8 weeks',
            'ownership' => 'You see progress at every stage',
        ],
    ],

    'proofs' => [
        'badge' => 'Our projects',
        'title' => 'Systems we built and run every day',
        'subtitle' => 'These are working products, not mock-ups. Browse the screenshots or open the product itself.',
        'view_live' => 'Open the product',
        'gallery_hint' => 'Screenshots from the running products',
        'gallery_open' => 'Open screenshot',
        'gallery_close' => 'Close',
        'gallery_prev' => 'Previous screenshot',
        'gallery_next' => 'Next screenshot',
        'gallery_count' => 'Screenshots: :count',
        'projects' => [
            'digipulse' => [
                'badge' => 'Our own product',
                'name' => 'DigiPulse',
                'screens' => [
                    ['file' => 'digipulse-dashboard', 'caption' => 'Overview: which websites work, which are slow or down, and when certificates expire (site names blurred)'],
                    ['file' => 'digipulse-history', 'caption' => 'History of one website: response time over the week and every incident'],
                ],
                'tagline' => 'Tells you the moment your website stops working',
                'stack' => ['Alerts in Telegram and email', 'Uptime reports', 'Checks every minute'],
                'live_url' => 'https://digipulse.cloud',
            ],
            'vetspace' => [
                'badge' => 'Booking and client management',
                'name' => 'VetSpace & VetCard',
                'screens' => [
                    ['file' => 'vetspace-clinic-month', 'caption' => 'Month view: how many appointments each doctor has on every day (demo data)'],
                    ['file' => 'vetspace-clinic-calendar', 'caption' => 'Clinic calendar: appointments of every doctor and room, new requests on the right (demo data)'],
                    ['file' => 'vetspace-admin-plans', 'caption' => 'Admin panel: plans and payments of the clinics using the platform'],
                    ['file' => 'vetspace-swagger-appointments', 'caption' => 'Documented connection points, so other systems can exchange appointments with it'],
                ],
                'tagline' => 'Online booking, calendar, client records and a page for every clinic',
                'stack' => ['Online booking', 'Calendar and CRM', 'Clinic page'],
                'live_url' => 'https://vetspace.pro',
            ],
            // Not a public product: one line under the showcase cards, linking the descriptive repository.
            'netpostpanel' => [
                'name' => 'NetPostPanel',
                'mention' => 'We also built :name, an AI assistant that prepares articles and posts from reliable sources: AI that works on your own data (RAG). The AI tools on this site run on it.',
                'live_url' => 'https://github.com/Yurij2015/net-post-panel-overview',
                'link_label' => 'Read the overview on GitHub',
            ],
        ],
    ],

    'engine' => [
        'title' => 'What we can build for you',
        'subtitle' => 'At the start we agree on what your business really needs. We don’t build what you won’t use.',
        'pillars' => [
            'multitenancy' => [
                'title' => 'Online booking and calendar',
            ],
            'billing' => [
                'title' => 'Online payments and subscriptions',
            ],
            'workers' => [
                'title' => 'Client records and CRM',
            ],
            'admin' => [
                'title' => 'Admin panel for your team',
            ],
            'ai' => [
                'title' => 'AI assistants on your data',
            ],
            'devops' => [
                'title' => 'Integrations with your tools',
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
                'title' => 'You see progress from the first week',
                'desc' => 'In the first week you get a private test version of your system. Every finished change appears there automatically, so you check the real thing rather than reading reports.',
            ],
            'testing' => [
                'badge' => 'Quality',
                'title' => 'Checked before every update',
                'desc' => 'Automated checks go through the key scenarios — booking, sign-up, payment — the way your clients would, before each update goes live.',
            ],
            'ownership' => [
                'badge' => 'Collaboration',
                'title' => 'Access to code during development',
                'desc' => 'We work in your GitHub repository or give you access to ours during development. We agree on the setup at the start.',
            ],
            'direct' => [
                'badge' => 'Direct contact',
                'title' => 'You talk to the person who builds it',
                'desc' => 'No account managers in between: you discuss tasks directly with the senior developer who writes the code.',
            ],
        ],
    ],

    'process' => [
        'title' => 'Four stages to launch',
        'subtitle' => 'Each stage takes up to two weeks and ends with a demo on the test version. With a smaller scope the stages are shorter, and launch can happen in 6 weeks.',
        'sprints' => [
            's1' => [
                'name' => 'Planning and foundation',
                'duration' => 'Weeks 1–2',
                'desc' => 'We map your process and set up a base that can grow with the business.',
            ],
            's2' => [
                'name' => 'Main features and payments',
                'duration' => 'Weeks 3–4',
                'desc' => 'The core of what the system does for you, plus online payments if needed.',
            ],
            's3' => [
                'name' => 'Client area and admin panel',
                'duration' => 'Weeks 5–6',
                'desc' => 'What your clients and your team will use every day.',
            ],
            's4' => [
                'name' => 'Testing and launch',
                'duration' => 'Weeks 7–8',
                'desc' => 'Final checks, a security review and deployment to the agreed hosting environment.',
            ],
        ],
    ],

    'pricing' => [
        'net_label' => 'net',
        'vat_note' => 'All prices are net. As a Polish VAT payer, we add VAT under Polish law (23% for clients in Poland).',
        'comparison_note' => 'A software house with a team and a project manager suits large projects. For most business systems one senior developer is enough — which is why the budget is lower.',
        'badge' => 'Pricing',
        'title' => 'Pricing: two ways to work together',
        'subtitle' => 'A fixed scope and price for the first version of your system, or monthly support for a system that is already running.',
        'plans' => [
            'mvp' => [
                'name' => 'New system',
                'badge' => 'For a new system',
                'price' => 'from $4,800',
                'price_sub' => '≈ 19,000 PLN · fixed scope',
                'timeline' => 'Typically 6–8 weeks',
                'desc' => 'For businesses that want their own booking, client portal, CRM or internal tool instead of spreadsheets and third-party platforms.',
                'features' => [
                    'Analysis of your process and a clear scope',
                    'Online booking, client area or internal tool — as agreed',
                    'Admin panel for your team',
                    'Private test version from the first week',
                    'Automated checks of the key scenarios',
                    'Deployment to the agreed hosting environment',
                    'Access to code and project documentation',
                    '2 weeks of post-launch fixes included',
                ],
                'cta' => 'Discuss your system',
            ],
            'retainer' => [
                'name' => 'Ongoing support',
                'badge' => 'For a running system',
                'price' => 'from $2,400',
                'price_sub' => '≈ 9,500 PLN · per month',
                'timeline' => 'Monthly',
                'desc' => 'For a system already in use that needs new features, improvements, integrations or reliable maintenance.',
                'features' => [
                    'Review of the system, data and security',
                    'New features and integrations',
                    'Speed and reliability improvements',
                    'Monitoring and updates',
                    'Direct Telegram channel',
                    'A reserved number of hours per week',
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
        'role' => 'Founder of DigiSpace · Systems Architect',
        'bio' => "Building a product used to take a full dev team. Today, precise planning, strong AI models and agents take over much of that work: thousands of man-hours turn into hundreds.\n\nI work with proven processes for design, development and fast deployment. You get a reliable system in 6–8 weeks and can move straight to automating your business and winning customers.",
        'more_links' => 'Videos and blog',
        'facts' => [
            '8+ years of commercial development',
            'Booking systems, CRMs, client portals, AI tools',
            'Own products in daily use: DigiPulse, VetSpace, NetPostPanel',
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
        'title' => 'Common questions about custom software',
        'subtitle' => 'Timelines, costs, hosting and working together.',
        'items' => [
            'q1' => [
                'q' => 'How long does it take?',
                'a' => 'The first version includes the 3–5 features that matter most to your business. The typical plan is four two-week stages; with a smaller scope launch can happen in 6 weeks. If more is needed, we say so at the estimate stage and plan the next steps together.',
            ],
            'q2' => [
                'q' => 'How do you manage access to the code?',
                'a' => 'We work in your GitHub repository or give you access to ours during development. We agree on code handover and hosting for the finished product before work begins.',
            ],
            'q3' => [
                'q' => 'How much does it cost to keep it running?',
                'a' => 'We provide a test environment during development. Hosting for the finished product and payment arrangements are agreed separately. Costs depend on the expected load and the services needed.',
            ],
            'q4' => [
                'q' => 'What do you need from me to start?',
                'a' => 'A short description of what you want to improve: which process, who uses it and what takes too much time today. Fill in the form on this page or message us on Telegram; then, on a short call online or at a meeting in Poznań, we agree on the scope.',
            ],
            'q5' => [
                'q' => 'How do you ensure the stable operation of the system?',
                'a' => 'The system runs on modern isolated servers with several layers of automated checks. Every update is tested before release, so issues are caught before your clients see them.',
            ],
            'q6' => [
                'q' => 'How does payment work?',
                'a' => 'Payment is split across the four stages: 25% at the start of each; escrow is also possible. You see the result of each stage on the test version before paying for the next one.',
            ],
            'q7' => [
                'q' => 'Do you work with companies in Poznań and the surrounding area?',
                'a' => 'Yes. We are in Stęszew, just outside Poznań, so with clients from Poznań and Poznań County — Luboń, Komorniki, Dopiewo, Mosina, Puszczykowo, Swarzędz, Suchy Las, Tarnowo Podgórne — we can meet in person: at your office or in Poznań, for example for the kick-off or before the launch. Clients from the rest of Poland and abroad work with us remotely, with the same process.',
            ],
        ],
    ],

    'contact' => [
        'badge' => 'Get in touch',
        'title' => 'Tell us about your business',
        'subtitle' => 'Fill in the short form or message us on Telegram, and we will reply with a scope and timeline estimate.',
        'telegram_cta' => 'Message on Telegram',
        'telegram_hint' => 'We usually reply the same day',
        'email_cta' => 'Send an email',
        'form' => [
            'project_name' => 'Your name or company',
            'project_name_placeholder' => 'Anna / Your Company Ltd',
            'contact' => 'Telegram or email',
            'contact_placeholder' => '@username or name@company.com',
            'stage' => 'What you have now',
            'not_specified' => 'Not specified',
            'stage_options' => [
                'idea' => 'An idea or a manual process to improve',
                'spec' => 'A written description of what is needed',
                'rewrite' => 'A system that needs changes or replacing',
            ],
            'budget' => 'Budget',
            'budget_options' => [
                'sprint' => '$4,800 – $8,500 (first version)',
                'custom' => '$8,500+ (larger system, AI)',
                'retainer' => 'Monthly support',
            ],
            'description' => 'What should the system do?',
            'description_placeholder' => 'For example: online booking for 3 specialists, client history and reminders',
            'submit' => 'Get an estimate',
            'response_time' => 'We reply within one business day.',
            'errors_title' => 'Please check the form:',
            'validation' => [
                'required' => 'Please fill in “:attribute”.',
                'max' => '“:attribute” is too long (up to :max characters).',
                'invalid' => 'Please choose a value from the list for “:attribute”.',
            ],
            'recaptcha_failed' => 'We could not confirm the form was sent by a person. Please try again or message us on Telegram.',
            'recaptcha_notice' => 'Protected by reCAPTCHA:',
            'recaptcha_privacy' => 'Google Privacy Policy',
            'recaptcha_terms' => 'Terms of Service',
            'privacy_notice' => 'The data controller is Yurii Mokryi JDG. We use the data from this form only to reply to your inquiry.',
            'success_title' => 'Thank you!',
            'success_message' => 'We have received your message and will reply within one business day with questions or a first estimate.',
        ],
    ],

    'footer' => [
        'legal' => 'Yurii Mokryi JDG · NIP 7773404080 · REGON 524949632',
        'privacy_policy' => 'Privacy policy',
        'tagline' => 'Custom software for businesses',
        'all_rights_reserved' => 'All rights reserved',
        'location' => 'Stęszew near Poznań, Wielkopolska, Poland.',
    ],
];
