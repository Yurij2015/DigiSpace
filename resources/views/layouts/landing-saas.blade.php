<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- Theme before first paint: the visitor's saved choice wins, otherwise the OS preference. --}}
    <script>
        (function () {
            var saved = null;
            try { saved = localStorage.getItem('saas-theme'); } catch (e) {}
            var dark = saved ? saved === 'dark' : window.matchMedia('(prefers-color-scheme: dark)').matches;
            document.documentElement.classList.toggle('dark', dark);
        })();
    </script>

    <title>@yield('title', __('saas.seo.title'))</title>
    <meta name="description" content="@yield('meta_description', __('saas.seo.description'))">
    <meta name="robots" content="index, follow">

    {{-- Canonical & Alternate hreflang --}}
    <link rel="canonical" href="{{ route('development.saas', ['locale' => app()->getLocale()], true) }}">
    @foreach(config('locales.supported') as $altLocale)
        <link rel="alternate" hreflang="{{ $altLocale }}" href="{{ route('development.saas', ['locale' => $altLocale], true) }}">
    @endforeach
    <link rel="alternate" hreflang="x-default" href="{{ route('development.saas', ['locale' => config('locales.default')], true) }}">

    {{-- Favicons --}}
    <link rel="alternate icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicons/site.svg') }}" type="image/svg+xml">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    {{-- Open Graph & Twitter --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('development.saas', ['locale' => app()->getLocale()], true) }}">
    <meta property="og:title" content="@yield('title', __('saas.seo.title'))">
    <meta property="og:description" content="@yield('meta_description', __('saas.seo.description'))">
    <meta property="og:image" content="{{ asset('images/og-default.png') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="DigiSpace">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', __('saas.seo.title'))">
    <meta name="twitter:description" content="@yield('meta_description', __('saas.seo.description'))">
    <meta name="twitter:image" content="{{ asset('images/og-default.png') }}">

    {{-- Isolated Tailwind CSS Asset --}}
    @vite(['resources/css/landing-saas.css'])

    {{-- JSON-LD Structured Data --}}
    @php
        $structuredData = [
            '@context' => 'https://schema.org',
            '@type' => 'ProfessionalService',
            'name' => 'DigiSpace',
            'description' => __('saas.seo.description'),
            'url' => route('development.saas', ['locale' => app()->getLocale()], true),
            'email' => 'admin@digispace.pro',
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Poznań',
                'addressRegion' => 'Wielkopolskie',
                'addressCountry' => 'PL',
            ],
            'areaServed' => [
                ['@type' => 'City', 'name' => 'Poznań'],
                ['@type' => 'AdministrativeArea', 'name' => 'Wielkopolskie'],
                ['@type' => 'Country', 'name' => 'Poland'],
                'European Union',
            ],
            'founder' => [
                '@type' => 'Person',
                'name' => 'Yurii Mokryi',
                'jobTitle' => 'Full-Stack Developer',
                'sameAs' => [
                    'https://github.com/Yurij2015',
                    'https://linkedin.com/in/yurii-mokryi',
                ],
            ],
        ];
    @endphp
    <script type="application/ld+json">@json($structuredData)</script>
</head>
<body class="bg-slate-50/70 text-slate-900 dark:bg-slate-950 dark:text-slate-100 antialiased font-['Plus_Jakarta_Sans',sans-serif] selection:bg-indigo-600 selection:text-white flex flex-col min-h-screen">

    {{-- Navigation Header --}}
    <header class="fixed top-0 inset-x-0 z-50 bg-white/80 dark:bg-slate-950/80 backdrop-blur-md border-b border-slate-200/70 dark:border-slate-800 transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 sm:h-20 flex items-center justify-between">
            {{-- Brand Logo --}}
            <a href="{{ route('home.index', ['locale' => app()->getLocale()]) }}" class="flex items-center gap-2 group focus:outline-none">
                <span class="size-9 sm:size-10 rounded-xl bg-slate-950 text-white dark:bg-white dark:text-slate-950 font-black flex items-center justify-center text-lg tracking-wider shadow-sm group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                    D
                </span>
                <div class="flex flex-col">
                    <span class="font-bold text-slate-950 dark:text-white text-base sm:text-lg leading-tight tracking-tight">DigiSpace</span>
                    <span class="hidden sm:block whitespace-nowrap text-[10px] font-semibold tracking-widest uppercase text-slate-400">{{ __('saas.nav.location') }}</span>
                </div>
            </a>

            {{-- Desktop Nav Anchors --}}
            <nav class="hidden md:flex items-center gap-7 text-sm font-medium text-slate-600 dark:text-slate-400">
                <a href="#proofs" class="hover:text-slate-950 dark:hover:text-white transition-colors">{{ __('saas.nav.proofs') }}</a>
                <a href="#engine" class="hover:text-slate-950 dark:hover:text-white transition-colors">{{ __('saas.nav.engine') }}</a>
                <a href="#guarantees" class="hover:text-slate-950 dark:hover:text-white transition-colors">{{ __('saas.nav.guarantees') }}</a>
                <a href="#process" class="hover:text-slate-950 dark:hover:text-white transition-colors">{{ __('saas.nav.process') }}</a>
                <a href="#pricing" class="hover:text-slate-950 dark:hover:text-white transition-colors">{{ __('saas.nav.pricing') }}</a>
                <a href="#faq" class="hover:text-slate-950 dark:hover:text-white transition-colors">{{ __('saas.nav.faq') }}</a>
            </nav>

            {{-- Right Actions: Theme, Language Switcher & Call CTA --}}
            <div class="flex items-center gap-2 sm:gap-3">
                {{-- Theme Toggle --}}
                <button type="button" data-theme-toggle
                        aria-label="{{ __('saas.nav.theme_toggle') }}" title="{{ __('saas.nav.theme_toggle') }}"
                        class="size-8 sm:size-9 inline-flex items-center justify-center rounded-full border border-slate-200/60 dark:border-slate-700 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:text-slate-950 dark:hover:text-white transition-colors cursor-pointer">
                    {{-- Moon: shown in light mode --}}
                    <svg class="size-4 dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
                    </svg>
                    {{-- Sun: shown in dark mode --}}
                    <svg class="size-4 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <circle cx="12" cy="12" r="4" stroke-width="2"/>
                        <path stroke-linecap="round" stroke-width="2" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32l1.41 1.41M2 12h2m16 0h2M4.93 19.07l1.41-1.41m11.32-11.32l1.41-1.41"/>
                    </svg>
                </button>

                {{-- Language Switcher Pills --}}
                <div class="flex items-center bg-slate-100 dark:bg-slate-800 p-0.5 rounded-full text-xs font-semibold text-slate-600 dark:text-slate-400 border border-slate-200/60 dark:border-slate-700">
                    @foreach(config('locales.supported') as $loc)
                        <a href="{{ route('development.saas', ['locale' => $loc]) }}"
                           class="px-2.5 py-1 rounded-full transition-all {{ app()->getLocale() === $loc ? 'bg-white text-slate-950 dark:bg-slate-950 dark:text-white shadow-xs font-bold' : 'hover:text-slate-900 dark:hover:text-white text-slate-500 dark:text-slate-400' }}">
                            {{ config("locales.short_labels.$loc", strtoupper($loc)) }}
                        </a>
                    @endforeach
                </div>

                {{-- Direct Action --}}
                <a href="https://t.me/YuriiMokryi" target="_blank" rel="noopener noreferrer"
                   class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold text-white bg-slate-950 dark:bg-white dark:text-slate-950 hover:bg-indigo-600 dark:hover:bg-indigo-500 dark:hover:text-white transition-colors shadow-xs">
                    <span>{{ __('saas.nav.cta') }}</span>
                    <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </header>

    {{-- Main Content Slot --}}
    <main class="flex-grow pt-16 sm:pt-20">
        @yield('content')
    </main>

    {{-- Clean Minimalist Footer --}}
    <footer class="bg-white dark:bg-slate-900 border-t border-slate-200/80 dark:border-slate-800 py-12 sm:py-16 text-slate-500 dark:text-slate-400 text-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex flex-col sm:flex-row items-center gap-3 text-center sm:text-left">
                    <span class="font-bold text-slate-900 dark:text-white text-base">DigiSpace</span>
                    <span class="hidden sm:inline text-slate-300 dark:text-slate-700">|</span>
                    <span>{{ __('saas.footer.tagline') }}</span>
                </div>

                {{-- External Profiles & Contact --}}
                <div class="flex flex-wrap justify-center items-center gap-5 font-medium text-slate-600 dark:text-slate-300">
                    <a href="https://t.me/YuriiMokryi" target="_blank" rel="noopener noreferrer" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Telegram</a>
                    <a href="https://github.com/Yurij2015" target="_blank" rel="noopener noreferrer" class="hover:text-slate-950 dark:hover:text-white transition-colors">GitHub</a>
                    <a href="https://linkedin.com/in/yurii-mokryi" target="_blank" rel="noopener noreferrer" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">LinkedIn</a>
                    <a href="mailto:admin@digispace.pro" class="hover:text-slate-950 dark:hover:text-white transition-colors">admin@digispace.pro</a>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400">
                <p>&copy; {{ date('Y') }} DigiSpace. {{ __('saas.footer.all_rights_reserved') }}. {{ __('saas.footer.location') }}</p>
                <div class="flex items-center gap-4">
                    <a href="{{ route('privacy-policy', ['locale' => app()->getLocale()]) }}" class="hover:underline">{{ __('saas.footer.privacy_policy') }}</a>
                    <a href="{{ route('home.index', ['locale' => app()->getLocale()]) }}" class="hover:underline">{{ __('site.home') }}</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        (function () {
            var root = document.documentElement;
            var media = window.matchMedia('(prefers-color-scheme: dark)');

            document.querySelectorAll('[data-theme-toggle]').forEach(function (button) {
                button.addEventListener('click', function () {
                    var dark = !root.classList.contains('dark');
                    root.classList.toggle('dark', dark);
                    try { localStorage.setItem('saas-theme', dark ? 'dark' : 'light'); } catch (e) {}
                });
            });

            // Without an explicit choice the page keeps following the OS setting live.
            media.addEventListener('change', function (event) {
                var saved = null;
                try { saved = localStorage.getItem('saas-theme'); } catch (e) {}
                if (!saved) {
                    root.classList.toggle('dark', event.matches);
                }
            });
        })();
    </script>
    @stack('scripts')
</body>
</html>
