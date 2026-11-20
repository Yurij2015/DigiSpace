<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth bg-white dark:bg-slate-950">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ __('development.index.seo.description') }}">
    <meta name="robots" content="index, follow">
    <title>{{ __('development.index.seo.title') }}</title>

    <script>
        (function () {
            var saved = null;
            try { saved = localStorage.getItem('saas-theme'); } catch (e) {}
            var dark = saved ? saved === 'dark' : window.matchMedia('(prefers-color-scheme: dark)').matches;
            document.documentElement.classList.toggle('dark', dark);
        })();
    </script>

    <link rel="canonical" href="{{ route('development.index', ['locale' => app()->getLocale()], true) }}">
    @foreach(config('locales.supported') as $altLocale)
        <link rel="alternate" hreflang="{{ $altLocale }}" href="{{ route('development.index', ['locale' => $altLocale], true) }}">
    @endforeach
    <link rel="alternate" hreflang="x-default" href="{{ route('development.index', ['locale' => config('locales.default')], true) }}">

    <link rel="alternate icon" href="{{ asset('favicons/digispace-d.ico') }}?v={{ filemtime(public_path('favicons/digispace-d.ico')) }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicons/digispace-d.svg') }}?v={{ filemtime(public_path('favicons/digispace-d.svg')) }}" type="image/svg+xml">

    @php
        $ogFile = 'landing/og-development-'.app()->getLocale().'.png';
        $ogImage = file_exists(public_path($ogFile))
            ? asset($ogFile).'?v='.filemtime(public_path($ogFile))
            : asset('images/og-default.png');
    @endphp
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('development.index', ['locale' => app()->getLocale()], true) }}">
    <meta property="og:title" content="{{ __('development.index.seo.title') }}">
    <meta property="og:description" content="{{ __('development.index.seo.description') }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="DigiSpace">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ __('development.index.seo.title') }}">
    <meta name="twitter:description" content="{{ __('development.index.seo.description') }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    @vite(['resources/css/landing-saas.css'])
    <link rel="stylesheet" href="{{ asset('css/cookie-consent.css') }}?v={{ filemtime(public_path('css/cookie-consent.css')) }}">
    @include('partials.tracking.consent-mode')

    @php
        $serviceList = collect($landings)->map(fn (string $slug, int $index): array => [
            '@type' => 'ListItem',
            'position' => $index + 1,
            'name' => __($slug.'.hero.title'),
            'url' => route('development.'.$slug, ['locale' => app()->getLocale()], true),
        ])->all();
        $structuredData = [
            '@context' => 'https://schema.org',
            '@type' => 'ItemList',
            'name' => __('development.index.hero.title'),
            'itemListElement' => $serviceList,
        ];
    @endphp
    <script type="application/ld+json">@json($structuredData)</script>
</head>
<body class="flex min-h-screen flex-col bg-slate-50/70 font-sans text-slate-900 antialiased selection:bg-indigo-600 selection:text-white dark:bg-slate-950 dark:text-slate-100">
    <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:left-3 focus:top-3 focus:z-[60] focus:rounded-lg focus:bg-white focus:px-4 focus:py-2 focus:text-slate-950 focus:shadow-lg dark:focus:bg-slate-900 dark:focus:text-white">
        {{ __('development.index.skip') }}
    </a>

    <header class="fixed inset-x-0 top-0 z-50 border-b border-slate-200/70 bg-white/80 backdrop-blur-md dark:border-slate-800 dark:bg-slate-950/80">
        <div class="mx-auto flex h-16 max-w-7xl items-center justify-between gap-3 px-4 sm:h-20 sm:px-6 lg:px-8">
            <a href="{{ route('home.index', ['locale' => app()->getLocale()]) }}" class="flex shrink-0 items-center gap-2 rounded-lg focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-indigo-500">
                <img src="{{ asset('favicons/digispace-d.svg') }}?v={{ filemtime(public_path('favicons/digispace-d.svg')) }}" alt="" width="32" height="32" class="size-7 sm:size-8">
                <span class="text-base font-bold tracking-tight text-slate-950 dark:text-white sm:text-lg">DigiSpace</span>
            </a>

            <div class="flex items-center gap-2 sm:gap-3">
                <button type="button" data-theme-toggle aria-label="{{ __('development.index.theme_toggle') }}" title="{{ __('development.index.theme_toggle') }}"
                        class="inline-flex size-9 items-center justify-center rounded-full border border-slate-200/60 bg-slate-100 text-slate-600 transition-colors hover:text-slate-950 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 dark:hover:text-white">
                    <svg class="size-4 dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
                    </svg>
                    <svg class="hidden size-4 dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <circle cx="12" cy="12" r="4" stroke-width="2"/>
                        <path stroke-linecap="round" stroke-width="2" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32l1.41 1.41M2 12h2m16 0h2M4.93 19.07l1.41-1.41m11.32-11.32l1.41-1.41"/>
                    </svg>
                </button>

                <nav aria-label="{{ __('development.index.language') }}" class="flex items-center rounded-full border border-slate-200/60 bg-slate-100 p-0.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400">
                    @foreach(config('locales.supported') as $locale)
                        <a href="{{ route('development.index', ['locale' => $locale]) }}"
                           @if(app()->getLocale() === $locale) aria-current="page" @endif
                           class="rounded-full px-2.5 py-1 transition-colors {{ app()->getLocale() === $locale ? 'bg-white font-bold text-slate-950 shadow-xs dark:bg-slate-950 dark:text-white' : 'text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white' }}">
                            {{ config("locales.short_labels.$locale", strtoupper($locale)) }}
                        </a>
                    @endforeach
                </nav>

                <a href="{{ route('contact-us', ['locale' => app()->getLocale()]) }}"
                   class="hidden rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-indigo-700 dark:hover:bg-indigo-500 sm:inline-flex">
                    {{ __('development.index.contact_link') }}
                </a>
            </div>
        </div>
    </header>

    <main id="main" tabindex="-1" class="flex-grow pt-16 outline-none sm:pt-20">
        <section class="relative overflow-hidden px-4 pb-14 pt-16 sm:px-6 sm:pb-20 sm:pt-24 lg:px-8">
            <div class="pointer-events-none absolute -top-40 left-1/2 -z-10 h-[420px] w-[760px] -translate-x-1/2 rounded-full bg-gradient-to-br from-indigo-100/70 via-cyan-50/50 to-transparent blur-3xl dark:opacity-20"></div>
            <div class="mx-auto max-w-4xl text-center">
                <p class="inline-flex items-center gap-2 rounded-full border border-slate-200/90 bg-white px-3.5 py-1.5 text-xs font-semibold text-slate-700 shadow-xs dark:border-slate-800 dark:bg-slate-900 dark:text-slate-300">
                    <span class="size-2 rounded-full bg-emerald-500" aria-hidden="true"></span>
                    {{ __('development.index.hero.eyebrow') }}
                </p>
                <h1 class="mt-6 text-balance text-4xl font-extrabold leading-tight tracking-tight text-slate-950 dark:text-white sm:text-6xl">
                    {{ __('development.index.hero.title') }}
                </h1>
                <p class="mx-auto mt-5 max-w-3xl text-pretty text-base leading-relaxed text-slate-600 dark:text-slate-400 sm:text-xl">
                    {{ __('development.index.hero.subtitle') }}
                </p>
            </div>
        </section>

        <section aria-label="{{ __('development.index.services_heading') }}" class="px-4 pb-20 sm:px-6 lg:px-8">
            <div class="mx-auto grid max-w-7xl gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-3">
                @foreach($landings as $slug)
                    <a href="{{ route('development.'.$slug, ['locale' => app()->getLocale()]) }}"
                       class="group relative flex min-h-64 flex-col overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:border-indigo-300 hover:shadow-xl hover:shadow-slate-900/5 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-indigo-500 dark:border-slate-800 dark:bg-slate-900 dark:hover:border-indigo-700 dark:hover:shadow-black/20 sm:p-7">
                        <div class="flex items-start justify-between gap-4">
                            <span class="inline-flex size-11 items-center justify-center rounded-xl bg-indigo-50 text-sm font-bold tracking-wide text-indigo-700 dark:bg-indigo-950 dark:text-indigo-300">
                                {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}
                            </span>
                            <svg class="mt-1 size-5 text-slate-400 transition duration-200 group-hover:-translate-y-0.5 group-hover:translate-x-0.5 group-hover:text-indigo-600 dark:text-slate-500 dark:group-hover:text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 17 17 7M7 7h10v10"/>
                            </svg>
                        </div>
                        <h2 class="mt-6 text-xl font-bold tracking-tight text-slate-950 dark:text-white sm:text-2xl">
                            {{ __($slug.'.hero.title') }}
                        </h2>
                        <p class="mt-3 flex-grow text-sm leading-relaxed text-slate-600 dark:text-slate-400 sm:text-base">
                            {{ __($slug.'.hero.subtitle_short') }}
                        </p>
                        <span class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-indigo-700 dark:text-indigo-300">
                            {{ __('development.index.card_link') }}
                            <span class="transition-transform group-hover:translate-x-1" aria-hidden="true">→</span>
                        </span>
                    </a>
                @endforeach
            </div>
        </section>

        <section class="px-4 pb-20 sm:px-6 lg:px-8">
            <div class="mx-auto flex max-w-7xl flex-col items-start justify-between gap-6 rounded-3xl border border-slate-200/80 bg-white p-7 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:flex-row sm:items-center sm:p-10">
                <div class="max-w-2xl">
                    <h2 class="text-2xl font-bold tracking-tight text-slate-950 dark:text-white sm:text-3xl">
                        {{ __('development.index.contact.title') }}
                    </h2>
                    <p class="mt-3 leading-relaxed text-slate-600 dark:text-slate-400">
                        {{ __('development.index.contact.subtitle') }}
                    </p>
                </div>
                <a href="{{ route('contact-us', ['locale' => app()->getLocale()]) }}"
                   class="inline-flex shrink-0 items-center gap-2 rounded-md bg-indigo-600 px-5 py-3 font-semibold text-white transition-colors hover:bg-indigo-700 dark:hover:bg-indigo-500">
                    {{ __('development.index.contact_link') }}
                    <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>
        </section>
    </main>

    <footer class="border-t border-slate-200/80 bg-white py-8 text-sm text-slate-500 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-400">
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-4 px-4 text-center sm:flex-row sm:px-6 sm:text-left lg:px-8">
            <p>&copy; {{ date('Y') }} DigiSpace. {{ __('development.index.footer') }}</p>
            <div class="flex flex-wrap items-center justify-center gap-5">
                <a href="{{ route('privacy-policy', ['locale' => app()->getLocale()]) }}" class="hover:text-slate-950 dark:hover:text-white">
                    {{ __('saas.footer.privacy_policy') }}
                </a>
                <button type="button" class="site-cookie-consent__open cursor-pointer hover:text-slate-950 dark:hover:text-white"
                        data-consent-open aria-haspopup="dialog" aria-expanded="false" aria-controls="site-cookie-consent">
                    {{ __('site.cookie_settings') }}
                </button>
                <a href="{{ route('home.index', ['locale' => app()->getLocale()]) }}" class="hover:text-slate-950 dark:hover:text-white">
                    {{ __('site.home') }}
                </a>
            </div>
        </div>
    </footer>

    <script>
        (function () {
            var root = document.documentElement;
            var media = window.matchMedia('(prefers-color-scheme: dark)');
            var buttons = document.querySelectorAll('[data-theme-toggle]');

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
    <x-cookie-consent/>
    @include('partials.tracking.google-analytics')
    @include('partials.tracking.clarity')
</body>
</html>
