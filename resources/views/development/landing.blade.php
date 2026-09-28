{{-- One template, several landings: SaasController passes $copy (the lang file: saas, business),
     $landingRoute (route name for canonical/hreflang/form) and $leadSource (contact_forms.source,
     analytics label). Layout and copy structure stay identical across the landings. --}}
@extends('layouts.landing-saas')

@section('title', __($copy.'.seo.title'))
@section('meta_description', __($copy.'.seo.description'))

@push('head')
    @php
        $faqStructuredData = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => collect(__($copy.'.faq.items'))->map(fn (array $item): array => [
                '@type' => 'Question',
                'name' => $item['q'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $item['a']],
            ])->values()->all(),
        ];
    @endphp
    <script type="application/ld+json">@json($faqStructuredData)</script>
@endpush

@section('content')

{{-- =========================================================================
     1. HERO SECTION
     ========================================================================= --}}
{{-- Mobile spacing is tight on purpose: both CTAs must sit above the cookie bar on a first visit --}}
<section class="relative overflow-hidden pt-8 pb-16 sm:pt-20 sm:pb-32">
    {{-- Ambient Background Glow --}}
    <div class="pointer-events-none absolute -top-40 left-1/2 -translate-x-1/2 w-[700px] sm:w-[1000px] h-[400px] sm:h-[500px] bg-gradient-to-tr from-indigo-100/60 via-blue-50/50 to-indigo-50/20 blur-3xl opacity-70 dark:opacity-15 -z-10"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        {{-- Availability & studio badge: a static dot, since the status is set by hand, not live --}}
        <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full text-xs font-semibold bg-white border border-slate-200/90 shadow-xs mb-6 sm:mb-8 text-slate-700 dark:bg-slate-900 dark:border-slate-800 dark:text-slate-300">
            <span class="inline-flex rounded-full size-2.5 bg-emerald-500" aria-hidden="true"></span>
            <span class="text-slate-900 font-bold dark:text-slate-100">{{ __($copy.'.hero.status') }}</span>
            <span class="hidden sm:inline text-slate-300 dark:text-slate-600" aria-hidden="true">|</span>
            <span class="hidden sm:inline text-slate-500 font-medium dark:text-slate-400">{{ __($copy.'.hero.badge') }}</span>
        </div>

        {{-- Main Headline --}}
        <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold text-slate-950 tracking-tight max-w-4xl mx-auto leading-[1.12] dark:text-white">
            {{ __($copy.'.hero.title') }}
        </h1>

        {{-- Subtitle --}}
        <p class="mt-4 sm:mt-6 text-base sm:text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed font-normal dark:text-slate-400">
            {{-- Phones get the short version: the full one is six lines there and pushes both CTAs under the cookie bar --}}
            <span class="sm:hidden">{{ __($copy.'.hero.subtitle_short') }}</span>
            <span class="hidden sm:inline">{{ __($copy.'.hero.subtitle') }}</span>
        </p>

        {{-- Hero CTAs --}}
        <div class="mt-7 sm:mt-10 flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4">
            <a href="#contact" data-testid="hero-cta" class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-8 py-3.5 sm:py-4 rounded-xl text-base font-semibold text-white bg-slate-950 hover:bg-indigo-600 transition-all shadow-sm hover:shadow-md dark:bg-white dark:text-slate-950 dark:hover:bg-indigo-500 dark:hover:text-white">
                {{-- The short label keeps the phone button on one line; the full one fits from sm up --}}
                <span class="sm:hidden">{{ __($copy.'.nav.cta') }}</span>
                <span class="hidden sm:inline">{{ __($copy.'.hero.cta_primary') }}</span>
                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
            <a href="https://t.me/YuriiMokryi" target="_blank" rel="noopener noreferrer" data-testid="hero-telegram" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3.5 sm:py-4 rounded-xl text-base font-semibold text-slate-700 bg-white hover:bg-slate-50 hover:text-slate-950 border border-slate-200/90 transition-all shadow-xs dark:text-slate-300 dark:bg-slate-900 dark:hover:bg-slate-800 dark:hover:text-white dark:border-slate-800">
                <svg class="size-5 text-sky-500 dark:text-sky-400" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19-.14.75-.42 1-.68 1.03-.58.05-1.02-.38-1.58-.75-.88-.58-1.38-.94-2.23-1.5-.99-.65-.35-1.01.22-1.59.15-.15 2.71-2.48 2.76-2.69a.2.2 0 00-.05-.18c-.06-.05-.14-.03-.21-.02-.09.02-1.49.95-4.22 2.79-.4.27-.76.41-1.08.4-.36-.01-1.04-.2-1.55-.37-.63-.2-1.12-.31-1.08-.66.02-.18.27-.36.74-.55 2.92-1.27 4.86-2.11 5.83-2.51 2.78-1.16 3.35-1.36 3.73-1.36.08 0 .27.02.39.12.1.08.13.19.14.27-.01.06.01.24 0 .38z"/></svg>
                <span>{{ __($copy.'.contact.telegram_cta') }}</span>
            </a>
        </div>

        {{-- Trust bar: price anchor first, since budget is the first question of this audience --}}
        @php
            $heroMetrics = [
                'price' => ['box' => 'bg-indigo-50 border-indigo-100 text-indigo-600 dark:bg-indigo-500/10 dark:border-indigo-500/25 dark:text-indigo-400', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                'timeline' => ['box' => 'bg-blue-50 border-blue-100 text-blue-600 dark:bg-blue-500/10 dark:border-blue-500/25 dark:text-blue-400', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                'ownership' => ['box' => 'bg-emerald-50 border-emerald-100 text-emerald-600 dark:bg-emerald-500/10 dark:border-emerald-500/25 dark:text-emerald-400', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
            ];
        @endphp
        <div class="mt-12 sm:mt-16 grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4 max-w-4xl mx-auto">
            @foreach($heroMetrics as $key => $metric)
                <div class="p-4 sm:p-5 rounded-2xl bg-white border border-slate-200/70 shadow-xs flex items-center gap-4 text-left dark:bg-slate-900 dark:border-slate-800">
                    <div class="size-11 rounded-xl border flex items-center justify-center shrink-0 {{ $metric['box'] }}">
                        <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $metric['icon'] }}"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ __("{$copy}.hero.metric_labels.$key") }}</div>
                        <div class="text-base font-bold text-slate-900 dark:text-slate-100">{{ __("{$copy}.hero.metrics.$key") }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


{{-- =========================================================================
     2. PROOF OF WORK: OUR OWN PRODUCTS IN PRODUCTION
     ========================================================================= --}}
@php
    // Badge colours are spelled out in full so Tailwind's scanner picks them up.
    $projects = [
        'digipulse' => ['dot' => 'bg-emerald-500', 'pill' => 'bg-emerald-50 text-emerald-700 border-emerald-200/60 dark:bg-emerald-500/10 dark:text-emerald-300 dark:border-emerald-500/25'],
        'vetspace' => ['dot' => 'bg-blue-500', 'pill' => 'bg-blue-50 text-blue-700 border-blue-200/60 dark:bg-blue-500/10 dark:text-blue-300 dark:border-blue-500/25'],
        'netpostpanel' => ['dot' => 'bg-purple-500', 'pill' => 'bg-purple-50 text-purple-700 border-purple-200/60 dark:bg-purple-500/10 dark:text-purple-300 dark:border-purple-500/25'],
    ];
@endphp
<section id="proofs" class="py-16 sm:py-24 bg-white border-t border-slate-200/80 dark:bg-slate-900 dark:border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase text-indigo-700 bg-indigo-50 border border-indigo-100 mb-4 dark:text-indigo-300 dark:bg-indigo-500/10 dark:border-indigo-500/25">
                {{ __($copy.'.proofs.badge') }}
            </span>
            <h2 class="text-3xl sm:text-5xl font-extrabold text-slate-950 tracking-tight dark:text-white">
                {{ __($copy.'.proofs.title') }}
            </h2>
            <p class="mt-4 text-base sm:text-lg text-slate-600 dark:text-slate-400">
                {{ __($copy.'.proofs.subtitle') }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($projects as $key => $style)
                <article class="flex flex-col rounded-3xl overflow-hidden border border-slate-200/80 bg-slate-50/50 hover:border-slate-300 transition-colors dark:border-slate-800 dark:bg-slate-950/40 dark:hover:border-slate-700">
                    @include('development.partials.project-gallery', ['project' => $key])
                    <div class="flex flex-col flex-1 gap-3 p-6">
                        <span class="self-start inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold border {{ $style['pill'] }}">
                            <span class="size-2 rounded-full {{ $style['dot'] }}"></span>
                            {{ __("{$copy}.proofs.projects.$key.badge") }}
                        </span>
                        <h3 class="text-2xl font-extrabold text-slate-950 dark:text-white">{{ __("{$copy}.proofs.projects.$key.name") }}</h3>
                        <p class="text-sm sm:text-base text-slate-600 dark:text-slate-400">{{ __("{$copy}.proofs.projects.$key.tagline") }}</p>
                        {{-- Three headline technologies as plain text: the buyer needs a signal, not a stack audit --}}
                        <p class="text-xs font-medium text-slate-500 dark:text-slate-400">
                            {{ implode(' · ', array_slice(__("{$copy}.proofs.projects.$key.stack"), 0, 3)) }}
                        </p>
                        <a href="{{ __("{$copy}.proofs.projects.$key.live_url") }}" target="_blank" rel="noopener noreferrer"
                           class="mt-auto pt-3 self-start inline-flex items-center gap-1.5 text-sm font-semibold text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300">
                            {{ \Illuminate\Support\Facades\Lang::has("{$copy}.proofs.projects.$key.link_label") ? __("{$copy}.proofs.projects.$key.link_label") : __($copy.'.proofs.view_live') }}
                            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

{{-- Shared screenshot lightbox: pages through the shots of the project that was opened --}}
<dialog data-gallery-dialog aria-label="{{ __($copy.'.proofs.gallery_hint') }}"
        class="m-auto w-[min(96vw,1600px)] max-h-[94vh] p-0 bg-transparent backdrop:bg-slate-950/85">
    <figure class="relative">
        <img data-gallery-image src="" alt="" class="w-full h-auto max-h-[84vh] object-contain rounded-xl bg-slate-900">
        <figcaption data-gallery-caption class="mt-3 text-center text-sm text-slate-200"></figcaption>
        <button type="button" data-gallery-close aria-label="{{ __($copy.'.proofs.gallery_close') }}"
                class="absolute top-3 right-3 size-10 inline-flex items-center justify-center rounded-full bg-slate-950/70 text-white hover:bg-slate-950 cursor-pointer">
            <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <button type="button" data-gallery-step="-1" aria-label="{{ __($copy.'.proofs.gallery_prev') }}"
                class="absolute left-3 top-[42%] size-10 inline-flex items-center justify-center rounded-full bg-slate-950/70 text-white hover:bg-slate-950 cursor-pointer">
            <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button type="button" data-gallery-step="1" aria-label="{{ __($copy.'.proofs.gallery_next') }}"
                class="absolute right-3 top-[42%] size-10 inline-flex items-center justify-center rounded-full bg-slate-950/70 text-white hover:bg-slate-950 cursor-pointer">
            <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    </figure>
</dialog>


{{-- =========================================================================
     3. WHO IS BEHIND IT: FOUNDER + CLIENT FEEDBACK
     ========================================================================= --}}
<section id="founder" class="py-16 sm:py-24 bg-slate-50/70 border-t border-slate-200/80 dark:bg-slate-950 dark:border-slate-800">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <div class="p-6 sm:p-8 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 flex flex-col sm:flex-row gap-6 sm:gap-8 items-center sm:items-start">
            <img src="{{ asset('landing/yurii-mokryi.jpg') }}?v={{ filemtime(public_path('landing/yurii-mokryi.jpg')) }}"
                 alt="{{ __($copy.'.founder.name') }}" width="112" height="112" loading="lazy" decoding="async"
                 class="size-24 sm:size-28 shrink-0 rounded-full object-cover ring-4 ring-slate-50 dark:ring-slate-800 shadow-sm">
            <div class="space-y-4 text-center sm:text-left">
                <div>
                    <span class="text-xs font-bold tracking-wider uppercase text-slate-500 dark:text-slate-400">{{ __($copy.'.founder.badge') }}</span>
                    <h2 class="mt-1 text-2xl font-extrabold text-slate-950 dark:text-white">{{ __($copy.'.founder.name') }}</h2>
                    <p class="text-sm font-medium text-slate-600 dark:text-slate-400">{{ __($copy.'.founder.role') }}</p>
                </div>
                <p class="text-sm sm:text-base leading-relaxed text-slate-700 dark:text-slate-300">{{ __($copy.'.founder.bio') }}</p>
                <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm text-slate-700 dark:text-slate-300 text-left">
                    @foreach(__($copy.'.founder.facts') as $fact)
                        <li class="flex items-start gap-2">
                            <svg class="size-4 mt-0.5 shrink-0 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>{{ $fact }}</span>
                        </li>
                    @endforeach
                </ul>
                {{-- Professional profiles carry the trust; the video channels are a quieter secondary line --}}
                <div class="flex flex-wrap justify-center sm:justify-start gap-2 pt-1">
                    @foreach(['linkedin' => 'LinkedIn', 'github' => 'GitHub', 'upwork' => 'Upwork'] as $key => $label)
                        <a href="{{ __($copy.'.founder.links.' . $key) }}" target="_blank" rel="noopener noreferrer"
                           class="px-3 py-1.5 rounded-lg text-sm font-semibold text-slate-700 dark:text-slate-200 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:border-slate-400 dark:hover:border-slate-500 transition-colors">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
                <p class="text-sm text-slate-600 dark:text-slate-400">
                    {{ __($copy.'.founder.more_links') }}:
                    @foreach(['youtube' => 'YouTube', 'tiktok' => 'TikTok', 'instagram' => 'Instagram'] as $key => $label)
                        <a href="{{ __($copy.'.founder.links.' . $key) }}" target="_blank" rel="noopener noreferrer"
                           class="font-semibold underline-offset-2 hover:underline hover:text-slate-950 dark:hover:text-white">{{ $label }}</a>@if(! $loop->last) · @endif
                    @endforeach
                </p>
            </div>
        </div>

        <div id="reviews">
            <h3 class="mb-4 text-center text-xs font-bold tracking-wider uppercase text-slate-500 dark:text-slate-400">
                {{ __($copy.'.social_proof.badge') }}
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                @foreach(__($copy.'.social_proof.items') as $review)
                    <figure class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 flex flex-col justify-between gap-4">
                        <blockquote class="text-sm sm:text-base leading-relaxed text-slate-700 dark:text-slate-300">
                            &ldquo;{{ $review['quote'] }}&rdquo;
                        </blockquote>
                        <figcaption class="text-xs font-semibold text-slate-500 dark:text-slate-400">
                            @isset($review['url'])
                                <a href="{{ $review['url'] }}" target="_blank" rel="noopener noreferrer" class="hover:text-indigo-600 dark:hover:text-indigo-400 underline-offset-2 hover:underline">{{ $review['source'] }}</a>
                            @else
                                {{ $review['source'] }}
                            @endisset
                        </figcaption>
                    </figure>
                @endforeach
            </div>
        </div>
    </div>
</section>


{{-- =========================================================================
     4. HOW WE WORK: FOUR PROMISES, THE EIGHT-WEEK PLAN, WHAT CAN BE INCLUDED
     ========================================================================= --}}
<section id="guarantees" class="py-16 sm:py-24 bg-white border-t border-slate-200/80 dark:bg-slate-900 dark:border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase text-indigo-700 bg-indigo-50 border border-indigo-100 mb-4 dark:text-indigo-300 dark:bg-indigo-500/10 dark:border-indigo-500/25">
                {{ __($copy.'.guarantees.badge') }}
            </span>
            <h2 class="text-3xl sm:text-5xl font-extrabold text-slate-950 tracking-tight dark:text-white">
                {{ __($copy.'.guarantees.title') }}
            </h2>
            <p class="mt-4 text-base sm:text-lg text-slate-600 dark:text-slate-400">
                {{ __($copy.'.guarantees.subtitle') }}
            </p>
        </div>

        {{-- Four promises --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            @foreach(['staging', 'testing', 'ownership', 'direct'] as $key)
                <div class="p-6 rounded-2xl bg-slate-50/60 border border-slate-200/80 space-y-2 dark:bg-slate-950/40 dark:border-slate-800">
                    <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-bold bg-white text-slate-700 border border-slate-200/80 dark:bg-slate-900 dark:text-slate-300 dark:border-slate-800">
                        {{ __($copy.'.guarantees.items.' . $key . '.badge') }}
                    </span>
                    <h3 class="text-lg font-extrabold text-slate-950 dark:text-white">
                        {{ __($copy.'.guarantees.items.' . $key . '.title') }}
                    </h3>
                    <p class="text-sm text-slate-600 leading-relaxed dark:text-slate-400">
                        {{ __($copy.'.guarantees.items.' . $key . '.desc') }}
                    </p>
                </div>
            @endforeach
        </div>

        {{-- The eight-week plan --}}
        <div id="process" class="mt-16 sm:mt-20">
            <div class="text-center max-w-2xl mx-auto mb-8">
                <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-950 dark:text-white">{{ __($copy.'.process.title') }}</h3>
                <p class="mt-2 text-sm sm:text-base text-slate-600 dark:text-slate-400">{{ __($copy.'.process.subtitle') }}</p>
            </div>
            {{-- A timeline, not another row of cards: vertical on phones, horizontal from lg --}}
            <ol class="grid grid-cols-1 lg:grid-cols-4 gap-8 lg:gap-6 max-w-md mx-auto lg:max-w-none">
                @foreach(__($copy.'.process.sprints') as $sprint)
                    <li class="relative pl-7 border-l-2 border-indigo-200 lg:pl-0 lg:pt-7 lg:border-l-0 lg:border-t-2 dark:border-indigo-500/30">
                        <span class="absolute -left-[7px] top-0 size-3 rounded-full bg-indigo-600 ring-4 ring-white lg:left-0 lg:-top-[7px] dark:bg-indigo-400 dark:ring-slate-900" aria-hidden="true"></span>
                        <p class="text-xs font-bold uppercase tracking-wider text-indigo-700 dark:text-indigo-300">{{ $sprint['duration'] }}</p>
                        <h4 class="mt-1.5 text-lg font-extrabold text-slate-950 dark:text-white">{{ $sprint['name'] }}</h4>
                        <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">{{ $sprint['desc'] }}</p>
                    </li>
                @endforeach
            </ol>
        </div>

        {{-- Building blocks, picked per product --}}
        <div id="engine" class="mt-12 sm:mt-16 max-w-4xl mx-auto text-center">
            <h3 class="text-lg font-extrabold text-slate-950 dark:text-white">{{ __($copy.'.engine.title') }}</h3>
            <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">{{ __($copy.'.engine.subtitle') }}</p>
            {{-- Plain text, not pill-shaped: bordered chips read as buttons that do nothing when tapped --}}
            <ul class="mt-4 flex flex-wrap justify-center gap-x-5 gap-y-2 text-sm font-semibold text-slate-700 dark:text-slate-300">
                @foreach(__($copy.'.engine.pillars') as $pillar)
                    <li class="inline-flex items-center gap-1.5">
                        <svg class="size-4 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        {{ $pillar['title'] }}
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="mt-12 text-center">
            <a href="#contact" class="inline-flex items-center justify-center gap-2.5 px-8 py-4 rounded-xl text-base font-semibold text-white bg-slate-950 hover:bg-indigo-600 transition-all shadow-sm hover:shadow-md dark:bg-white dark:text-slate-950 dark:hover:bg-indigo-500 dark:hover:text-white">
                <span>{{ __($copy.'.hero.cta_primary') }}</span>
                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>
    </div>
</section>


{{-- =========================================================================
     5. PRICING & ENGAGEMENT MODELS
     ========================================================================= --}}
<section id="pricing" class="py-20 sm:py-32 bg-white border-t border-slate-200/80 dark:bg-slate-900 dark:border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-16 sm:mb-20">
            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase text-indigo-700 bg-indigo-50 border border-indigo-100 mb-4 dark:text-indigo-300 dark:bg-indigo-500/10 dark:border-indigo-500/25">
                {{ __($copy.'.pricing.badge') }}
            </span>
            <h2 class="text-3xl sm:text-5xl font-extrabold text-slate-950 tracking-tight dark:text-white">
                {{ __($copy.'.pricing.title') }}
            </h2>
            <p class="mt-4 text-base sm:text-lg text-slate-600 dark:text-slate-400">
                {{ __($copy.'.pricing.subtitle') }}
            </p>
        </div>

        {{-- Both cards share the parent's row tracks (subgrid), so prices, lists and buttons line up --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 lg:grid-rows-[repeat(5,auto)] gap-8 max-w-5xl mx-auto">

            {{-- Plan 1: SaaS MVP, fixed scope (featured) --}}
            <div class="p-8 sm:p-10 rounded-3xl bg-slate-950 text-white border-2 border-indigo-500 shadow-xl flex flex-col gap-6 lg:grid lg:grid-rows-subgrid lg:row-span-5 relative overflow-hidden">
                    <div class="flex items-center justify-between">
                        <span class="px-3.5 py-1 rounded-full text-xs font-extrabold bg-indigo-600 text-white">
                            {{ __($copy.'.pricing.plans.mvp.badge') }}
                        </span>
                        <span class="text-xs font-medium text-slate-400">
                            {{ __($copy.'.pricing.plans.mvp.timeline') }}
                        </span>
                    </div>

                    <div>
                        <h3 class="text-2xl sm:text-3xl font-extrabold">
                            {{ __($copy.'.pricing.plans.mvp.name') }}
                        </h3>
                        <p class="mt-2 text-sm text-slate-300 leading-relaxed">
                            {{ __($copy.'.pricing.plans.mvp.desc') }}
                        </p>
                    </div>

                    <div class="py-4 border-y border-slate-800">
                        <div class="text-3xl sm:text-4xl font-black text-white">
                            {{ __($copy.'.pricing.plans.mvp.price') }}
                            <span class="text-base font-semibold text-slate-400">{{ __($copy.'.pricing.net_label') }}</span>
                        </div>
                        <div class="text-xs text-slate-400 mt-1">
                            {{ __($copy.'.pricing.plans.mvp.price_sub') }}
                        </div>
                    </div>

                    {{-- Features List --}}
                    <div class="space-y-3 pt-2">
                        @foreach(__($copy.'.pricing.plans.mvp.features') as $feature)
                            <div class="flex items-start gap-2.5 text-xs sm:text-sm text-slate-200">
                                <svg class="size-4 text-emerald-400 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span>{{ $feature }}</span>
                            </div>
                        @endforeach
                    </div>

                <div class="mt-auto">
                    <a href="#contact" class="w-full inline-flex items-center justify-center gap-2 px-6 py-4 rounded-xl text-base font-bold text-slate-950 bg-white hover:bg-indigo-50 transition-colors shadow-sm">
                        <span>{{ __($copy.'.pricing.plans.mvp.cta') }}</span>
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Plan 2: monthly senior support for a live product --}}
            <div class="p-8 sm:p-10 rounded-3xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-6 lg:grid lg:grid-rows-subgrid lg:row-span-5 hover:border-slate-300 transition-all dark:bg-slate-900 dark:border-slate-800 dark:hover:border-slate-700">
                    <div class="flex items-center justify-between">
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                            {{ __($copy.'.pricing.plans.retainer.badge') }}
                        </span>
                        <span class="text-xs font-medium text-slate-500 dark:text-slate-400">
                            {{ __($copy.'.pricing.plans.retainer.timeline') }}
                        </span>
                    </div>

                    <div>
                        <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-950 dark:text-white">
                            {{ __($copy.'.pricing.plans.retainer.name') }}
                        </h3>
                        <p class="mt-2 text-sm text-slate-600 leading-relaxed dark:text-slate-400">
                            {{ __($copy.'.pricing.plans.retainer.desc') }}
                        </p>
                    </div>

                    <div class="py-4 border-y border-slate-100 dark:border-slate-800">
                        <div class="text-3xl sm:text-4xl font-black text-slate-950 dark:text-white">
                            {{ __($copy.'.pricing.plans.retainer.price') }}
                            <span class="text-base font-semibold text-slate-500 dark:text-slate-400">{{ __($copy.'.pricing.net_label') }}</span>
                        </div>
                        <div class="text-xs text-slate-500 mt-1 dark:text-slate-400">
                            {{ __($copy.'.pricing.plans.retainer.price_sub') }}
                        </div>
                    </div>

                    {{-- Features List --}}
                    <div class="space-y-3 pt-2">
                        @foreach(__($copy.'.pricing.plans.retainer.features') as $feature)
                            <div class="flex items-start gap-2.5 text-xs sm:text-sm text-slate-700 dark:text-slate-300">
                                <svg class="size-4 text-indigo-600 shrink-0 mt-0.5 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span>{{ $feature }}</span>
                            </div>
                        @endforeach
                    </div>

                <div class="mt-auto">
                    <a href="https://t.me/YuriiMokryi" target="_blank" rel="noopener noreferrer"
                       class="w-full inline-flex items-center justify-center gap-2 px-6 py-4 rounded-xl text-base font-bold text-white bg-slate-950 hover:bg-indigo-600 transition-colors shadow-sm dark:bg-white dark:text-slate-950 dark:hover:bg-indigo-500 dark:hover:text-white">
                        <span>{{ __($copy.'.pricing.plans.retainer.cta') }}</span>
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                </div>
            </div>

        </div>

        <div class="mt-8 max-w-3xl mx-auto space-y-2 text-center text-sm text-slate-500 dark:text-slate-400">
            <p class="font-medium text-slate-700 dark:text-slate-300">{{ __($copy.'.pricing.comparison_note') }}</p>
            <p>{{ __($copy.'.pricing.vat_note') }}</p>
        </div>
    </div>
</section>


{{-- =========================================================================
     6. FREQUENTLY ASKED QUESTIONS (ACCORDION)
     ========================================================================= --}}
<section id="faq" class="py-20 sm:py-32 bg-slate-50/70 border-t border-slate-200/80 dark:bg-slate-950 dark:border-slate-800">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="text-center mb-16 sm:mb-20">
            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase text-indigo-700 bg-indigo-50 border border-indigo-100 mb-4 dark:text-indigo-300 dark:bg-indigo-500/10 dark:border-indigo-500/25">
                {{ __($copy.'.faq.badge') }}
            </span>
            <h2 class="text-3xl sm:text-5xl font-extrabold text-slate-950 tracking-tight dark:text-white">
                {{ __($copy.'.faq.title') }}
            </h2>
            <p class="mt-4 text-base sm:text-lg text-slate-600 dark:text-slate-400">
                {{ __($copy.'.faq.subtitle') }}
            </p>
        </div>

        {{-- Accordion Items --}}
        <div class="space-y-4">
            @foreach(__($copy.'.faq.items') as $item)
                <details class="group bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-7 transition-all [&_summary::-webkit-details-marker]:hidden open:shadow-xs dark:bg-slate-900 dark:border-slate-800">
                    <summary class="flex items-center justify-between cursor-pointer list-none gap-4">
                        <h3 class="font-bold text-slate-900 text-base sm:text-lg select-none dark:text-slate-100">
                            {{ $item['q'] }}
                        </h3>
                        <span class="size-8 rounded-full bg-slate-100 group-open:bg-indigo-50 group-open:text-indigo-600 text-slate-500 flex items-center justify-center shrink-0 transition-transform duration-200 group-open:rotate-180 dark:bg-slate-800 dark:group-open:bg-indigo-500/10 dark:group-open:text-indigo-400 dark:text-slate-400">
                            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </span>
                    </summary>
                    <p class="mt-4 text-sm sm:text-base text-slate-600 leading-relaxed border-t border-slate-100 pt-4 dark:text-slate-400 dark:border-slate-800">
                        {{ $item['a'] }}
                    </p>
                </details>
            @endforeach
        </div>
    </div>
</section>


{{-- =========================================================================
     7. PROJECT QUALIFICATION & INQUIRY FORM
     ========================================================================= --}}
<section id="contact" class="py-20 sm:py-32 bg-white border-t border-slate-200/80 dark:bg-slate-900 dark:border-slate-800">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-16 sm:mb-20">
            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase text-indigo-700 bg-indigo-50 border border-indigo-100 mb-4 dark:text-indigo-300 dark:bg-indigo-500/10 dark:border-indigo-500/25">
                {{ __($copy.'.contact.badge') }}
            </span>
            <h2 class="text-3xl sm:text-5xl font-extrabold text-slate-950 tracking-tight dark:text-white">
                {{ __($copy.'.contact.title') }}
            </h2>
            <p class="mt-4 text-base sm:text-lg text-slate-600 dark:text-slate-400">
                {{ __($copy.'.contact.subtitle') }}
            </p>
        </div>

        {{-- Form Container --}}
        <div class="bg-slate-50/70 rounded-3xl border border-slate-200/80 p-8 sm:p-12 shadow-xs dark:bg-slate-950 dark:border-slate-800">
            @if(session('saas_success'))
                <div class="p-6 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 mb-8 space-y-2 dark:bg-emerald-500/10 dark:border-emerald-500/25 dark:text-emerald-300">
                    <div class="flex items-center gap-2 font-bold text-base text-emerald-950 dark:text-emerald-300">
                        <svg class="size-5 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>{{ __($copy.'.contact.form.success_title') }}</span>
                    </div>
                    <p class="text-sm text-emerald-800 dark:text-emerald-300">
                        {{ __($copy.'.contact.form.success_message') }}
                    </p>
                </div>
            @endif

            @if($errors->any())
                <div class="p-5 rounded-2xl bg-rose-50 border border-rose-200 text-rose-900 text-sm mb-6 space-y-1 dark:bg-rose-500/10 dark:border-rose-500/25 dark:text-rose-300">
                    <div class="font-bold">{{ __($copy.'.contact.form.errors_title') }}</div>
                    <ul class="list-disc pl-5 text-xs text-rose-800 space-y-1 dark:text-rose-300">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route($landingRoute.'.inquiry', ['locale' => app()->getLocale()]) }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    {{-- Project Name --}}
                    <div>
                        <label for="project_name" class="block text-sm font-semibold text-slate-800 mb-1.5 dark:text-slate-200">
                            {{ __($copy.'.contact.form.project_name') }} <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="project_name" name="project_name" value="{{ old('project_name') }}" required autocomplete="name"
                               placeholder="{{ __($copy.'.contact.form.project_name_placeholder') }}"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-slate-900 text-base sm:text-sm focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all dark:border-slate-800 dark:bg-slate-900 dark:text-slate-100">
                    </div>

                    {{-- Telegram / Email Contact --}}
                    <div>
                        <label for="contact_handle" class="block text-sm font-semibold text-slate-800 mb-1.5 dark:text-slate-200">
                            {{ __($copy.'.contact.form.contact') }} <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="contact_handle" name="contact" value="{{ old('contact') }}" required autocomplete="email" autocapitalize="none" spellcheck="false"
                               placeholder="{{ __($copy.'.contact.form.contact_placeholder') }}"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-slate-900 text-base sm:text-sm focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all dark:border-slate-800 dark:bg-slate-900 dark:text-slate-100">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    {{-- Project Stage --}}
                    <div>
                        <label for="stage" class="block text-sm font-semibold text-slate-800 mb-1.5 dark:text-slate-200">
                            {{ __($copy.'.contact.form.stage') }}
                        </label>
                        <select id="stage" name="stage"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-slate-900 text-base sm:text-sm focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all dark:border-slate-800 dark:bg-slate-900 dark:text-slate-100">
                            <option value="">{{ __($copy.'.contact.form.not_specified') }}</option>
                            @foreach(__($copy.'.contact.form.stage_options') as $key => $label)
                                <option value="{{ $key }}" {{ old('stage') === $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Target Budget --}}
                    <div>
                        <label for="budget" class="block text-sm font-semibold text-slate-800 mb-1.5 dark:text-slate-200">
                            {{ __($copy.'.contact.form.budget') }}
                        </label>
                        <select id="budget" name="budget"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-slate-900 text-base sm:text-sm focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all dark:border-slate-800 dark:bg-slate-900 dark:text-slate-100">
                            <option value="">{{ __($copy.'.contact.form.not_specified') }}</option>
                            @foreach(__($copy.'.contact.form.budget_options') as $key => $label)
                                <option value="{{ $key }}" {{ old('budget') === $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="block text-sm font-semibold text-slate-800 mb-1.5 dark:text-slate-200">
                        {{ __($copy.'.contact.form.description') }} <span class="text-rose-500">*</span>
                    </label>
                    <textarea id="description" name="description" rows="4" required
                              placeholder="{{ __($copy.'.contact.form.description_placeholder') }}"
                              class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-slate-900 text-base sm:text-sm focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all dark:border-slate-800 dark:bg-slate-900 dark:text-slate-100">{{ old('description') }}</textarea>
                </div>

                {{-- Invisible reCAPTCHA v3: the token is requested on submit and posted in this field --}}
                <input type="hidden" name="g-recaptcha-response" value="" data-recaptcha-token>

                {{-- Submit: the same promise as the CTAs that lead here, plus when to expect the reply --}}
                <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-5">
                    <button type="submit" data-testid="inquiry-submit"
                            class="w-full sm:w-auto px-8 py-4 rounded-xl text-base font-bold text-white bg-slate-950 hover:bg-indigo-600 transition-all shadow-sm hover:shadow-md cursor-pointer flex items-center justify-center gap-2 dark:bg-white dark:text-slate-950 dark:hover:bg-indigo-500 dark:hover:text-white">
                        <span>{{ __($copy.'.contact.form.submit') }}</span>
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                    <p class="text-sm text-slate-600 dark:text-slate-400">{{ __($copy.'.contact.form.response_time') }}</p>
                </div>
                {{-- RODO/GDPR information, then the reCAPTCHA notice Google requires when its badge is hidden --}}
                <div class="space-y-1 text-xs leading-relaxed text-slate-500 dark:text-slate-400">
                    <p>
                        {{ __($copy.'.contact.form.privacy_notice') }}
                        <a href="{{ route('privacy-policy', ['locale' => app()->getLocale()]) }}" class="underline underline-offset-2 hover:text-slate-900 dark:hover:text-white">{{ __($copy.'.footer.privacy_policy') }}</a>.
                    </p>
                    <p>
                        {{ __($copy.'.contact.form.recaptcha_notice') }}
                        <a href="https://policies.google.com/privacy?hl={{ app()->getLocale() }}" target="_blank" rel="noopener noreferrer" class="underline underline-offset-2 hover:text-slate-900 dark:hover:text-white">{{ __($copy.'.contact.form.recaptcha_privacy') }}</a>
                        ·
                        <a href="https://policies.google.com/terms?hl={{ app()->getLocale() }}" target="_blank" rel="noopener noreferrer" class="underline underline-offset-2 hover:text-slate-900 dark:hover:text-white">{{ __($copy.'.contact.form.recaptcha_terms') }}</a>
                    </p>
                </div>
            </form>
        </div>
        {{-- Direct Action Bar: Telegram & Email --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-8">
            <a href="https://t.me/YuriiMokryi" target="_blank" rel="noopener noreferrer"
               class="p-5 rounded-2xl bg-indigo-50/60 border border-indigo-100/90 hover:bg-indigo-50 transition-all flex items-center justify-between group dark:bg-indigo-500/10 dark:border-indigo-500/25 dark:hover:bg-indigo-500/10">
                <div class="flex items-center gap-3.5">
                    <div class="size-11 rounded-xl bg-indigo-600 text-white flex items-center justify-center shrink-0">
                        <svg class="size-6" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19-.14.75-.42 1-.68 1.03-.58.05-1.02-.38-1.58-.75-.88-.58-1.38-.94-2.23-1.5-.99-.65-.35-1.01.22-1.59.15-.15 2.71-2.48 2.76-2.69a.2.2 0 00-.05-.18c-.06-.05-.14-.03-.21-.02-.09.02-1.49.95-4.22 2.79-.4.27-.76.41-1.08.4-.36-.01-1.04-.2-1.55-.37-.63-.2-1.12-.31-1.08-.66.02-.18.27-.36.74-.55 2.92-1.27 4.86-2.11 5.83-2.51 2.78-1.16 3.35-1.36 3.73-1.36.08 0 .27.02.39.12.1.08.13.19.14.27-.01.06.01.24 0 .38z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-extrabold text-slate-900 text-sm group-hover:text-indigo-600 transition-colors dark:text-slate-100 dark:group-hover:text-indigo-400">
                            {{ __($copy.'.contact.telegram_cta') }}
                        </div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">
                            {{ __($copy.'.contact.telegram_hint') }}
                        </div>
                    </div>
                </div>
                <span class="text-slate-400 group-hover:text-indigo-600 group-hover:translate-x-1 transition-all dark:group-hover:text-indigo-400">→</span>
            </a>

            <a href="mailto:admin@digispace.pro?subject={{ rawurlencode(__($copy.'.hero.badge')) }}"
               class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 hover:bg-slate-100/70 transition-all flex items-center justify-between group dark:bg-slate-800 dark:border-slate-800 dark:hover:bg-slate-800/70">
                <div class="flex items-center gap-3.5">
                    <div class="size-11 rounded-xl bg-slate-950 text-white flex items-center justify-center shrink-0 dark:bg-white dark:text-slate-950">
                        <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-extrabold text-slate-900 text-sm group-hover:text-slate-950 transition-colors dark:text-slate-100 dark:group-hover:text-white">
                            {{ __($copy.'.contact.email_cta') }}
                        </div>
                        <div class="text-xs text-slate-500 font-mono dark:text-slate-400">
                            admin@digispace.pro
                        </div>
                    </div>
                </div>
                <span class="text-slate-400 group-hover:text-slate-950 group-hover:translate-x-1 transition-all dark:group-hover:text-white">→</span>
            </a>
        </div>

    </div>
</section>

@endsection

@push('scripts')
    <script>
        // Project covers open the shared <dialog>, which pages through that project's shots
        // (buttons or the arrow keys); the counter goes into the caption.
        (function () {
            var dialog = document.querySelector('[data-gallery-dialog]');
            if (!dialog || typeof dialog.showModal !== 'function') return;
            var image = dialog.querySelector('[data-gallery-image]');
            var caption = dialog.querySelector('[data-gallery-caption]');
            var steppers = dialog.querySelectorAll('[data-gallery-step]');
            var items = [];
            var index = 0;

            function show() {
                var item = items[index];
                // Dark theme → the dark twin of the screenshot, when the product has one.
                image.src = document.documentElement.classList.contains('dark') && item.srcDark ? item.srcDark : item.src;
                image.alt = item.caption;
                caption.textContent = items.length > 1 ? item.caption + ' · ' + (index + 1) + ' / ' + items.length : item.caption;
                steppers.forEach(function (button) { button.hidden = items.length < 2; });
            }
            function step(delta) {
                if (items.length < 2) return;
                index = (index + delta + items.length) % items.length;
                show();
            }

            document.addEventListener('click', function (event) {
                var opener = event.target.closest('[data-gallery-open]');
                if (!opener) return;
                try { items = JSON.parse(opener.dataset.galleryItems); } catch (e) { items = []; }
                if (!items.length) return;
                index = 0;
                show();
                dialog.showModal();
            });
            steppers.forEach(function (button) {
                button.addEventListener('click', function () { step(Number(button.dataset.galleryStep)); });
            });
            dialog.addEventListener('keydown', function (event) {
                if (event.key === 'ArrowRight') step(1);
                if (event.key === 'ArrowLeft') step(-1);
            });
            dialog.querySelector('[data-gallery-close]').addEventListener('click', function () { dialog.close(); });
            // A click on the backdrop (outside the figure) closes it too.
            dialog.addEventListener('click', function (event) { if (event.target === dialog) dialog.close(); });
        })();
    </script>
    <script>
        // Conversion events for ad optimisation. Each fires only under the matching consent:
        // GA4 needs Analytics, the Meta Pixel needs Marketing (both are loaded by the shared partials).
        (function () {
            if (!window.DigiConsent) return;

            function sendAnalytics(event, params) {
                if (DigiConsent.isGranted('analytics') && typeof window.gtag === 'function') {
                    gtag('event', event, params);
                }
            }
            function sendMarketing(event, params) {
                if (DigiConsent.isGranted('marketing') && typeof window.fbq === 'function') {
                    fbq('track', event, params);
                }
            }

            // Interest signal: a click on Telegram or e-mail (the main contact path for now).
            document.addEventListener('click', function (event) {
                var link = event.target.closest('a[href^="https://t.me/"], a[href^="mailto:"]');
                if (!link) return;
                var method = link.href.indexOf('mailto:') === 0 ? 'email' : 'telegram';
                sendAnalytics('contact', { method: method, page: @json($leadSource) });
                sendMarketing('Contact', { content_name: method });
            });

            @if(session('saas_success'))
            // The inquiry was stored: report the lead once per consent category, even if the
            // visitor only grants consent after landing on this confirmation.
            var leadSent = { analytics: false, marketing: false };
            DigiConsent.on('analytics', function () {
                if (leadSent.analytics) return;
                leadSent.analytics = true;
                gtag('event', 'generate_lead', { form: @json($leadSource), page: @json($leadSource) });
            }, function () {
                // A sent event cannot be undone; the no-op stops consent.js from reloading
                // (and losing this one-time "thank you" page) when the visitor revokes consent.
            });
            DigiConsent.on('marketing', function () {
                if (leadSent.marketing || typeof window.fbq !== 'function') return;
                leadSent.marketing = true;
                fbq('track', 'Lead', { content_name: @json($leadSource) });
            }, function () {
                // See above: nothing to undo, and no reload wanted.
            });
            @endif
        })();
    </script>
    <script>
        // Invisible reCAPTCHA v3. The library is loaded only when the visitor approaches or focuses
        // the form (it costs ~300 ms of main-thread time and sets Google cookies), and a fresh token
        // is requested on submit, since v3 tokens expire after two minutes.
        (function () {
            var form = document.querySelector('#contact form');
            var tokenField = form && form.querySelector('[data-recaptcha-token]');
            var siteKey = @json(config('services.recaptcha_v3.site_key'));
            var action = @json(\App\Http\Requests\SaasInquirySaveRequest::RECAPTCHA_ACTION);
            if (!form || !tokenField || !siteKey) return;

            var loading = null;
            function loadRecaptcha() {
                if (!loading) {
                    loading = new Promise(function (resolve, reject) {
                        var script = document.createElement('script');
                        script.src = 'https://www.google.com/recaptcha/api.js?render=' + encodeURIComponent(siteKey) + '&hl=' + @json(app()->getLocale());
                        script.async = true;
                        script.onload = function () { window.grecaptcha.ready(resolve); };
                        script.onerror = reject;
                        document.head.appendChild(script);
                    });
                }
                return loading;
            }

            form.addEventListener('focusin', loadRecaptcha, { once: true });
            if ('IntersectionObserver' in window) {
                new IntersectionObserver(function (entries, observer) {
                    if (entries.some(function (entry) { return entry.isIntersecting; })) {
                        observer.disconnect();
                        loadRecaptcha();
                    }
                }, { rootMargin: '800px 0px' }).observe(form);
            }

            var submitting = false;
            form.addEventListener('submit', function (event) {
                if (submitting) return;
                event.preventDefault();
                submitting = true;
                var button = form.querySelector('button[type="submit"]');
                if (button) button.disabled = true;
                loadRecaptcha()
                    .then(function () { return window.grecaptcha.execute(siteKey, { action: action }); })
                    .then(function (token) { tokenField.value = token; })
                    .catch(function () { tokenField.value = ''; })
                    // Without a token the server answers with a clear validation message.
                    .then(function () { form.submit(); });
            });
        })();
    </script>
@endpush
