<?php

return [
    'seo' => [
        'title' => 'API Development, Payment & AI Integrations | DigiSpace',
        'description' => 'REST API development with OpenAPI documentation, Stripe and payment gateway integrations, CRM sync and AI/RAG search over your data. From $1,800 net.',
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
        'badge' => 'APIs · Payments · AI integrations',
        'title' => 'API development and payment, CRM & AI integrations',
        'subtitle' => 'We design and build APIs for web, mobile apps and partner services. We connect payments and subscriptions (Stripe and other REST gateways), sync CRM data and add AI search over your own documents.',
        'subtitle_short' => 'We build REST APIs, connect Stripe, CRM sync and AI/RAG search, complete with OpenAPI documentation, webhook handling and automated tests.',
        'cta_primary' => 'Get an integration estimate',
        'status' => 'Taking on new projects',
        'metric_labels' => [
            'price' => 'Budget',
            'timeline' => 'Timeline',
            'ownership' => 'Reliability',
        ],
        'metrics' => [
            'price' => 'From $1,800 net',
            'timeline' => 'Typically 1–4 weeks',
            'ownership' => 'OpenAPI docs & automated tests',
        ],
    ],

    'proofs' => [
        'badge' => 'Our projects',
        'title' => 'APIs, payments and AI integrations in running products',
        'subtitle' => 'Real examples from our own systems: OpenAPI documentation, Stripe billing, webhooks and RAG search over custom sources.',
        'view_live' => 'Open the product',
        'gallery_hint' => 'Screenshots from the running products',
        'gallery_open' => 'Open screenshot',
        'gallery_close' => 'Close',
        'gallery_prev' => 'Previous screenshot',
        'gallery_next' => 'Next screenshot',
        'gallery_count' => 'Screenshots: :count',
        'projects' => [
            'digipulse' => [
                'badge' => 'API + workers + alerts',
                'name' => 'DigiPulse',
                'screens' => [
                    ['file' => 'digipulse-dashboard', 'caption' => 'Website overview: availability, response times and SSL certificates (site names blurred)'],
                    ['file' => 'digipulse-history', 'caption' => 'Site history: response times and incidents over the past week'],
                ],
                'tagline' => 'Laravel backend integrated with Go workers, MCP server and Telegram/email alerting',
                'stack' => ['REST API', 'MCP', 'Webhooks', 'Go', 'Redis'],
                'live_url' => 'https://digipulse.cloud',
            ],
            'vetspace' => [
                'badge' => 'OpenAPI + Stripe Cashier',
                'name' => 'VetSpace & VetCard',
                'screens' => [
                    ['file' => 'vetspace-swagger-appointments', 'caption' => 'API documentation (Swagger/OpenAPI): requests for managing appointments'],
                    ['file' => 'vetspace-admin-plans', 'caption' => 'Filament admin panel: subscription plans synced with Stripe'],
                    ['file' => 'vetspace-clinic-calendar', 'caption' => 'Appointment calendar: filters by branch and doctor (demo data)'],
                    ['file' => 'vetspace-clinic-month', 'caption' => 'Monthly calendar: daily appointment counts for each doctor (demo data)'],
                ],
                'tagline' => 'Shared REST API for public directory, clinic dashboards and Stripe subscription sync',
                'stack' => ['OpenAPI / Swagger', 'Stripe Webhooks', 'Laravel API', 'PostgreSQL'],
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
        'title' => 'Integrations and APIs we build',
        'subtitle' => 'We build in error handling, retries and duplicate protection so data exchange stays predictable.',
        'pillars' => [
            'multitenancy' => [
                'title' => 'REST APIs for web, mobile apps and partners',
            ],
            'billing' => [
                'title' => 'Payments & subscriptions (Stripe and other REST gateways)',
            ],
            'workers' => [
                'title' => 'Webhooks, queues, retries and idempotency',
            ],
            'admin' => [
                'title' => 'CRM / ERP sync (Zoho and external REST APIs)',
            ],
            'ai' => [
                'title' => 'AI integrations and RAG search over your documents',
            ],
            'devops' => [
                'title' => 'OpenAPI / Swagger documentation and automated tests',
            ],
        ],
    ],

    'guarantees' => [
        'badge' => 'How we work',
        'title' => 'Predictable data exchange between systems',
        'subtitle' => 'We test failure paths, log external errors and hand over clear documentation.',
        'items' => [
            'staging' => [
                'badge' => 'Sandbox',
                'title' => 'Tested on sandbox credentials first',
                'desc' => 'We verify successful responses, declines, timeouts and duplicate webhooks in sandbox before switching to live keys.',
            ],
            'testing' => [
                'badge' => 'Tests',
                'title' => 'Automated contract and webhook tests',
                'desc' => 'Endpoints, auth and webhook handlers are covered by automated tests so future updates do not break API consumers.',
            ],
            'ownership' => [
                'badge' => 'Docs',
                'title' => 'OpenAPI / Swagger and request examples',
                'desc' => 'We deliver an up-to-date API spec so your frontend, mobile team or partners can integrate without guesswork.',
            ],
            'direct' => [
                'badge' => 'Direct contact',
                'title' => 'Direct contact with the developer',
                'desc' => 'You align on payload formats, permissions and edge cases directly with the engineer.',
            ],
        ],
    ],

    'process' => [
        'title' => 'Four stages to launch your API or integration',
        'subtitle' => 'From API contract to verified live traffic. Duration depends on the number of services and external API limits.',
        'sprints' => [
            's1' => [
                'name' => 'Contract and failure scenarios',
                'duration' => 'Stage 1',
                'desc' => 'We agree on endpoints, auth, payload formats, rate limits and failure behavior.',
            ],
            's2' => [
                'name' => 'Implementation and webhooks',
                'duration' => 'Stage 2',
                'desc' => 'We build the API or integration, webhook signature checks, queues and duplicate guards.',
            ],
            's3' => [
                'name' => 'Sandbox testing and docs',
                'duration' => 'Stage 3',
                'desc' => 'We write automated tests, check edge cases and finalize OpenAPI documentation.',
            ],
            's4' => [
                'name' => 'Launch and log checks',
                'duration' => 'Stage 4',
                'desc' => 'We switch to production credentials, configure error logging and verify the first real requests.',
            ],
        ],
    ],

    'pricing' => [
        'net_label' => 'net',
        'vat_note' => 'All prices are net. As a Polish VAT payer, we add VAT under Polish law (23% for clients in Poland).',
        'comparison_note' => 'Integration bugs usually show up as duplicate charges or dropped leads. Proper webhook handling and queues address those risks early.',
        'badge' => 'Pricing',
        'title' => 'API and integration pricing',
        'subtitle' => 'A fixed-scope integration or ongoing API expansion and maintenance.',
        'plans' => [
            'mvp' => [
                'name' => 'Turnkey API or integration',
                'badge' => 'Fixed scope',
                'price' => 'from $1,800',
                'price_sub' => 'Fixed scope',
                'timeline' => 'Typically 1–4 weeks',
                'desc' => 'REST API development, Stripe or another payment gateway, CRM sync or an AI/RAG module.',
                'features' => [
                    'API contract design and auth (OAuth, Sanctum, JWT)',
                    'Endpoints, webhook handlers and background queues',
                    'Idempotency protection and automatic retries',
                    'Error logging when an external service fails',
                    'OpenAPI / Swagger documentation',
                    'Automated tests for normal and failure cases',
                    'Sandbox checks and switch to production',
                    'Bug fixes for 2 weeks after launch',
                ],
                'cta' => 'Estimate an integration',
            ],
            'retainer' => [
                'name' => 'Ongoing API & integrations',
                'badge' => 'For a live product',
                'price' => 'from $1,600',
                'price_sub' => 'Per month · or from $35/hr',
                'timeline' => 'Monthly',
                'desc' => 'Gradual API expansion, new partner connectors, SDK updates and queue maintenance.',
                'features' => [
                    'New endpoints and partner integrations',
                    'External API version updates',
                    'Response caching and faster queries',
                    'Webhook and queue error checks',
                    'Direct Telegram or Slack communication',
                    'Agreed weekly engineering hours',
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
        'bio' => "I design backend services, REST APIs and external integrations: Stripe subscriptions, Zoho CRM connectors, service-to-service data exchange and RAG tools using Qdrant and Langfuse.\n\nI build error handling and retries into the architecture from the start so temporary third-party outages do not break business workflows.",
        'more_links' => 'Videos and blog',
        'facts' => [
            '8+ years of commercial development',
            'REST / OpenAPI, Stripe, Webhooks, Zoho CRM, AI/RAG',
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
        'title' => 'Common questions about APIs & integrations',
        'subtitle' => 'Payments, error handling, documentation and timelines.',
        'items' => [
            'q1' => [
                'q' => 'Which payment gateways do you integrate?',
                'a' => 'We regularly integrate Stripe (one-time payments, subscriptions, customer portal, webhooks) as well as other payment gateways that offer public REST API documentation and a sandbox.',
            ],
            'q2' => [
                'q' => 'Do you build AI integrations and RAG search?',
                'a' => 'Yes. We build search over your documents and knowledge base (RAG), structured output pipelines and LLM API integrations with usage logging and cost limits.',
            ],
            'q3' => [
                'q' => 'What happens if an external service goes down temporarily?',
                'a' => 'Critical calls and webhooks run through queues with retries, signature verification and idempotency checks. This reduces the risk of dropped leads or duplicate payments.',
            ],
            'q4' => [
                'q' => 'Do you provide documentation for mobile or frontend teams?',
                'a' => 'Yes, we deliver an OpenAPI / Swagger specification with request/response examples and error codes.',
            ],
            'q5' => [
                'q' => 'Which stack do you use to build APIs?',
                'a' => 'Primarily PHP (Laravel, Symfony) and Go, backed by PostgreSQL or MySQL and Redis for queues and caching.',
            ],
            'q6' => [
                'q' => 'How does payment work?',
                'a' => 'Fixed-scope integrations are split into an upfront deposit and final payment after sandbox checks and launch. Ongoing work is invoiced monthly or hourly.',
            ],
            'q7' => [
                'q' => 'Which countries do you work with?',
                'a' => 'We work remotely with clients in Ukraine, Poland, the EU, the UK, the US and Canada.',
            ],
        ],
    ],

    'contact' => [
        'badge' => 'Get in touch',
        'title' => 'Describe your API or integration',
        'subtitle' => 'Tell us which systems need to connect or what API you need built. We will send an initial timeline and cost estimate.',
        'telegram_cta' => 'Message on Telegram',
        'telegram_hint' => 'We usually reply the same day',
        'email_cta' => 'Send an email',
        'form' => [
            'project_name' => 'Your name or company',
            'project_name_placeholder' => 'Alex / Company Ltd',
            'contact' => 'Telegram or email',
            'contact_placeholder' => '@username or name@company.com',
            'stage' => 'Task type',
            'not_specified' => 'Not specified',
            'stage_options' => [
                'idea' => 'New API (for web / mobile app)',
                'spec' => 'Payment, CRM/ERP or third-party integration',
                'rewrite' => 'AI integration or existing API improvements',
            ],
            'budget' => 'Estimated budget',
            'budget_options' => [
                'sprint' => '$1,800 – $4,000 (integration / core API)',
                'custom' => '$4,000+ (complex API or multiple connectors)',
                'retainer' => 'Monthly support / hourly',
            ],
            'description' => 'Short integration description',
            'description_placeholder' => 'Which services need to be integrated and what data should sync?',
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
        'tagline' => 'API, payment and AI integrations',
        'all_rights_reserved' => 'All rights reserved',
        'location' => 'Stęszew near Poznań, Wielkopolska, Poland.',
    ],
];
