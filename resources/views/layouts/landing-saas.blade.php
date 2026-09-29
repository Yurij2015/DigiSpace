<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth scroll-pt-20 sm:scroll-pt-24">
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

    <title>@yield('title', __($copy.'.seo.title'))</title>
    <meta name="description" content="@yield('meta_description', __($copy.'.seo.description'))">
    <meta name="robots" content="index, follow">

    {{-- Canonical & Alternate hreflang --}}
    <link rel="canonical" href="{{ route($landingRoute, ['locale' => app()->getLocale()], true) }}">
    @foreach(config('locales.supported') as $altLocale)
        <link rel="alternate" hreflang="{{ $altLocale }}" href="{{ route($landingRoute, ['locale' => $altLocale], true) }}">
    @endforeach
    <link rel="alternate" hreflang="x-default" href="{{ route($landingRoute, ['locale' => config('locales.default')], true) }}">

    {{-- Favicons --}}
    <link rel="alternate icon" href="{{ asset('favicons/digispace-d.ico') }}?v={{ filemtime(public_path('favicons/digispace-d.ico')) }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicons/digispace-d.svg') }}?v={{ filemtime(public_path('favicons/digispace-d.svg')) }}" type="image/svg+xml">

    {{-- Open Graph & Twitter --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route($landingRoute, ['locale' => app()->getLocale()], true) }}">
    <meta property="og:title" content="@yield('title', __($copy.'.seo.title'))">
    <meta property="og:description" content="@yield('meta_description', __($copy.'.seo.description'))">
    {{-- Per landing and locale preview (public/landing, not public/images: deploys restore public/images
         from the previous release, which would bring back an old version of an updated file) --}}
    @php
        $ogFile = 'landing/og-'.$copy.'-'.app()->getLocale().'.png';
        $ogImage = file_exists(public_path($ogFile))
            ? asset($ogFile).'?v='.filemtime(public_path($ogFile))
            : asset('images/og-default.png');
    @endphp
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="DigiSpace">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', __($copy.'.seo.title'))">
    <meta name="twitter:description" content="@yield('meta_description', __($copy.'.seo.description'))">
    <meta name="twitter:image" content="{{ $ogImage }}">

    {{-- Isolated Tailwind CSS Asset --}}
    @vite(['resources/css/landing-saas.css'])

    {{-- Cookie consent (shared with the main site): banner styles, Consent Mode defaults, consent.js --}}
    <link rel="stylesheet" href="{{ asset('css/cookie-consent.css') }}?v={{ filemtime(public_path('css/cookie-consent.css')) }}">
    @include('partials.tracking.consent-mode')
    @include('partials.tracking.meta-pixel')

    {{-- JSON-LD Structured Data --}}
    @php
        $structuredData = [
            '@context' => 'https://schema.org',
            '@type' => 'ProfessionalService',
            'name' => 'DigiSpace',
            'legalName' => 'Yurii Mokryi JDG',
            'vatID' => 'PL7773404080',
            'description' => __($copy.'.seo.description'),
            'url' => route($landingRoute, ['locale' => app()->getLocale()], true),
            'email' => 'admin@digispace.pro',
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Stęszew',
                'addressRegion' => 'Wielkopolskie',
                'addressCountry' => 'PL',
            ],
            'areaServed' => [
                ['@type' => 'City', 'name' => 'Poznań'],
                ['@type' => 'City', 'name' => 'Stęszew'],
                ['@type' => 'AdministrativeArea', 'name' => 'Powiat poznański'],
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
    @stack('head')
</head>
<body data-landing="{{ $copy }}" class="bg-slate-50/70 text-slate-900 dark:bg-slate-950 dark:text-slate-100 antialiased font-sans selection:bg-indigo-600 selection:text-white flex flex-col min-h-screen">

    {{-- Skip link: first stop for keyboard users, visible only while focused --}}
    <a href="#main" data-testid="skip-link"
       class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-[60] focus:px-4 focus:py-2 focus:rounded-lg focus:bg-white focus:text-slate-950 focus:shadow-lg dark:focus:bg-slate-900 dark:focus:text-white">
        {{ __($copy.'.nav.skip') }}
    </a>

    {{-- Navigation Header --}}
    <header class="fixed top-0 inset-x-0 z-50 bg-white/80 dark:bg-slate-950/80 backdrop-blur-md border-b border-slate-200/70 dark:border-slate-800 transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 sm:h-20 flex items-center justify-between">
            {{-- Brand Logo --}}
            {{-- Mark + wordmark on one line. Optical alignment measured on the rendered fonts: the D's body
                 (below its pixel) is centred on the wordmark's capitals. --}}
            <a href="{{ route('home.index', ['locale' => app()->getLocale()]) }}" class="flex items-center gap-2 rounded-lg focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-indigo-500">
                <img src="{{ asset('favicons/digispace-d.svg') }}?v={{ filemtime(public_path('favicons/digispace-d.svg')) }}" alt="" width="32" height="32" class="size-7 -translate-y-[1.75px] sm:size-8 sm:-translate-y-[1.8px] shrink-0" data-logo-mark>
                <span class="font-bold text-slate-950 dark:text-white text-base sm:text-lg leading-tight tracking-tight" data-logo-wordmark>DigiSpace</span>
            </a>

            {{-- Desktop Nav Anchors --}}
            <nav class="hidden md:flex items-center gap-7 text-sm font-medium text-slate-600 dark:text-slate-400">
                <a href="#proofs" class="hover:text-slate-950 dark:hover:text-white transition-colors">{{ __($copy.'.nav.proofs') }}</a>
                <a href="#guarantees" class="hover:text-slate-950 dark:hover:text-white transition-colors">{{ __($copy.'.nav.guarantees') }}</a>
                <a href="#pricing" class="hover:text-slate-950 dark:hover:text-white transition-colors">{{ __($copy.'.nav.pricing') }}</a>
                <a href="#faq" class="hover:text-slate-950 dark:hover:text-white transition-colors">{{ __($copy.'.nav.faq') }}</a>
            </nav>

            {{-- Right Actions: Theme, Language Switcher & Call CTA --}}
            <div class="flex items-center gap-2 sm:gap-3">
                {{-- Theme Toggle --}}
                <button type="button" data-theme-toggle
                        aria-label="{{ __($copy.'.nav.theme_toggle') }}" title="{{ __($copy.'.nav.theme_toggle') }}"
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
                        <a href="{{ route($landingRoute, ['locale' => $loc]) }}"
                           class="px-2.5 py-1 rounded-full transition-all {{ app()->getLocale() === $loc ? 'bg-white text-slate-950 dark:bg-slate-950 dark:text-white shadow-xs font-bold' : 'hover:text-slate-900 dark:hover:text-white text-slate-500 dark:text-slate-400' }}">
                            {{ config("locales.short_labels.$loc", strtoupper($loc)) }}
                        </a>
                    @endforeach
                </div>

                {{-- Primary action: the form, like every other main CTA on the page --}}
                <a href="#contact" data-testid="header-cta"
                   class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-md text-sm font-semibold text-white bg-indigo-600 border border-transparent shadow-xs transition-colors duration-160 ease-out hover:bg-indigo-700 dark:hover:bg-indigo-500">
                    <span>{{ __($copy.'.nav.cta') }}</span>
                    <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </header>

    {{-- Main Content Slot --}}
    <main id="main" tabindex="-1" class="flex-grow pt-16 sm:pt-20 outline-none">
        @yield('content')
    </main>

    {{-- Clean Minimalist Footer --}}
    <footer class="bg-white dark:bg-slate-900 border-t border-slate-200/80 dark:border-slate-800 py-12 sm:py-16 text-slate-500 dark:text-slate-400 text-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex flex-col sm:flex-row items-center gap-3 text-center sm:text-left">
                    <span class="font-bold text-slate-900 dark:text-white text-base">DigiSpace</span>
                    <span class="hidden sm:inline text-slate-300 dark:text-slate-700">|</span>
                    <span>{{ __($copy.'.footer.tagline') }}</span>
                </div>

                {{-- External Profiles & Contact --}}
                <div class="flex flex-wrap justify-center items-center gap-5 font-medium text-slate-600 dark:text-slate-300">
                    <a href="https://t.me/YuriiMokryi" target="_blank" rel="noopener noreferrer" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Telegram</a>
                    <a href="https://github.com/Yurij2015" target="_blank" rel="noopener noreferrer" class="hover:text-slate-950 dark:hover:text-white transition-colors">GitHub</a>
                    <a href="https://linkedin.com/in/yurii-mokryi" target="_blank" rel="noopener noreferrer" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">LinkedIn</a>
                    <a href="mailto:admin@digispace.pro" class="hover:text-slate-950 dark:hover:text-white transition-colors">admin@digispace.pro</a>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500 dark:text-slate-400">
                <div class="space-y-1 text-center sm:text-left">
                    <p>&copy; {{ date('Y') }} DigiSpace. {{ __($copy.'.footer.all_rights_reserved') }}. {{ __($copy.'.footer.location') }}</p>
                    <p>{{ __($copy.'.footer.legal') }}</p>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('privacy-policy', ['locale' => app()->getLocale()]) }}" class="hover:underline">{{ __($copy.'.footer.privacy_policy') }}</a>
                    <button type="button" class="site-cookie-consent__open hover:underline cursor-pointer"
                            data-consent-open data-testid="cookie-settings"
                            aria-haspopup="dialog" aria-expanded="false" aria-controls="site-cookie-consent">
                        {{ __('site.cookie_settings') }}
                    </button>
                    <a href="{{ route('home.index', ['locale' => app()->getLocale()]) }}" class="hover:underline">{{ __('site.home') }}</a>
                </div>
            </div>
        </div>
    </footer>

    {{-- Mobile sticky CTA: on phones the header CTA is hidden and the form is at the very end,
         so the way to it stays one tap away. Shown after the hero, hidden near the form/footer. --}}
    <div data-sticky-cta aria-hidden="true"
         class="sm:hidden fixed inset-x-0 bottom-0 z-40 p-3 bg-white/90 dark:bg-slate-950/90 backdrop-blur-md border-t border-slate-200/80 dark:border-slate-800 translate-y-full transition-transform duration-300">
        <div class="flex">
        <a href="#contact" tabindex="-1"
           class="flex-1 flex items-center justify-center gap-2 px-6 py-3.5 rounded-md text-base font-semibold text-white bg-indigo-600 border border-transparent shadow-sm transition-colors duration-160 ease-out hover:bg-indigo-700 dark:hover:bg-indigo-500">
            <span>{{ __($copy.'.nav.cta') }}</span>
            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
        </a>
        </div>
    </div>

    <script>
        (function () {
            var bar = document.querySelector('[data-sticky-cta]');
            var hero = document.querySelector('main > section');
            var targets = [document.getElementById('contact'), document.querySelector('footer')].filter(Boolean);
            if (!bar || !hero || !('IntersectionObserver' in window)) return;

            var heroVisible = true;
            var nearForm = false;
            function update() {
                var show = !heroVisible && !nearForm;
                bar.classList.toggle('translate-y-full', !show);
                bar.setAttribute('aria-hidden', show ? 'false' : 'true');
                bar.querySelectorAll('a').forEach(function (link) { link.tabIndex = show ? 0 : -1; });
            }
            // The top margin excludes the area under the fixed header: a hero edge hidden there is not "visible".
            new IntersectionObserver(function (entries) {
                heroVisible = entries[0].isIntersecting;
                update();
            }, { rootMargin: '-96px 0px 0px 0px' }).observe(hero);
            var visibleTargets = new Set();
            var targetObserver = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    entry.isIntersecting ? visibleTargets.add(entry.target) : visibleTargets.delete(entry.target);
                });
                nearForm = visibleTargets.size > 0;
                update();
            });
            targets.forEach(function (target) { targetObserver.observe(target); });
        })();

        (function () {
            var root = document.documentElement;
            var media = window.matchMedia('(prefers-color-scheme: dark)');
            var buttons = document.querySelectorAll('[data-theme-toggle]');

            // aria-pressed tells screen readers whether dark mode is currently on.
            function syncPressed() {
                var dark = root.classList.contains('dark') ? 'true' : 'false';
                buttons.forEach(function (button) { button.setAttribute('aria-pressed', dark); });
            }

            buttons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var dark = !root.classList.contains('dark');
                    root.classList.toggle('dark', dark);
                    try { localStorage.setItem('saas-theme', dark ? 'dark' : 'light'); } catch (e) {}
                    syncPressed();
                });
            });
            syncPressed();

            // Without an explicit choice the page keeps following the OS setting live.
            media.addEventListener('change', function (event) {
                var saved = null;
                try { saved = localStorage.getItem('saas-theme'); } catch (e) {}
                if (!saved) {
                    root.classList.toggle('dark', event.matches);
                    syncPressed();
                }
            });
        })();
    </script>
    {{-- Consent banner and trackers: nothing below loads before the visitor grants the category --}}
    <x-cookie-consent/>
    @include('partials.tracking.google-analytics')
    @include('partials.tracking.clarity')
    @stack('scripts')
</body>
</html>
