@extends('layouts.landing-saas')

@section('title', __('saas.seo.title'))
@section('meta_description', __('saas.seo.description'))

@section('content')

{{-- =========================================================================
     1. HERO SECTION
     ========================================================================= --}}
<section class="relative overflow-hidden pt-12 pb-20 sm:pt-20 sm:pb-32">
    {{-- Ambient Background Glow --}}
    <div class="pointer-events-none absolute -top-40 left-1/2 -translate-x-1/2 w-[700px] sm:w-[1000px] h-[400px] sm:h-[500px] bg-gradient-to-tr from-indigo-100/60 via-blue-50/50 to-indigo-50/20 blur-3xl opacity-70 dark:opacity-15 -z-10"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        {{-- Live Status Indicator & Studio Badge --}}
        <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full text-xs font-semibold bg-white border border-slate-200/90 shadow-xs mb-8 text-slate-700 dark:bg-slate-900 dark:border-slate-800 dark:text-slate-300">
            <span class="relative flex h-2.5 w-2.5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
            </span>
            <span class="text-slate-900 font-bold dark:text-slate-100">{{ __('saas.hero.status') }}</span>
            <span class="text-slate-300">|</span>
            <span class="text-slate-500 font-medium dark:text-slate-400">{{ __('saas.hero.badge') }}</span>
        </div>

        {{-- Main Headline --}}
        <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold text-slate-950 tracking-tight max-w-4xl mx-auto leading-[1.12] dark:text-white">
            {{ __('saas.hero.title') }}
        </h1>

        {{-- Subtitle --}}
        <p class="mt-6 text-lg sm:text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed font-normal dark:text-slate-400">
            {{ __('saas.hero.subtitle') }}
        </p>

        {{-- Hero CTAs --}}
        <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="#contact" class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-8 py-4 rounded-xl text-base font-semibold text-white bg-slate-950 hover:bg-indigo-600 transition-all shadow-sm hover:shadow-md dark:bg-white dark:text-slate-950 dark:hover:bg-indigo-500 dark:hover:text-white">
                <span>{{ __('saas.hero.cta_primary') }}</span>
                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
            <a href="#proofs" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 rounded-xl text-base font-semibold text-slate-700 bg-white hover:bg-slate-50 hover:text-slate-950 border border-slate-200/90 transition-all shadow-xs dark:text-slate-300 dark:bg-slate-900 dark:hover:bg-slate-800 dark:hover:text-white dark:border-slate-800">
                <span>{{ __('saas.hero.cta_secondary') }}</span>
                <svg class="size-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </a>
        </div>

        {{-- 3 Hero Key Metrics / Trust Bar --}}
        <div class="mt-16 sm:mt-24 grid grid-cols-1 sm:grid-cols-3 gap-4 max-w-4xl mx-auto">
            <div class="p-5 rounded-2xl bg-white border border-slate-200/70 shadow-xs flex items-center gap-4 text-left dark:bg-slate-900 dark:border-slate-800">
                <div class="size-11 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 shrink-0 dark:bg-indigo-500/10 dark:border-indigo-500/25 dark:text-indigo-400">
                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <div class="text-xs font-semibold uppercase tracking-wider text-slate-400">{{ __('saas.hero.metric_labels.timeline') }}</div>
                    <div class="text-base font-bold text-slate-900 dark:text-slate-100">{{ __('saas.hero.metrics.timeline') }}</div>
                </div>
            </div>

            <div class="p-5 rounded-2xl bg-white border border-slate-200/70 shadow-xs flex items-center gap-4 text-left dark:bg-slate-900 dark:border-slate-800">
                <div class="size-11 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 shrink-0 dark:bg-emerald-500/10 dark:border-emerald-500/25 dark:text-emerald-400">
                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <div>
                    <div class="text-xs font-semibold uppercase tracking-wider text-slate-400">{{ __('saas.hero.metric_labels.ownership') }}</div>
                    <div class="text-base font-bold text-slate-900 dark:text-slate-100">{{ __('saas.hero.metrics.ownership') }}</div>
                </div>
            </div>

            <div class="p-5 rounded-2xl bg-white border border-slate-200/70 shadow-xs flex items-center gap-4 text-left dark:bg-slate-900 dark:border-slate-800">
                <div class="size-11 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600 shrink-0 dark:bg-blue-500/10 dark:border-blue-500/25 dark:text-blue-400">
                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <div>
                    <div class="text-xs font-semibold uppercase tracking-wider text-slate-400">{{ __('saas.hero.metric_labels.staging') }}</div>
                    <div class="text-base font-bold text-slate-900 dark:text-slate-100">{{ __('saas.hero.metrics.staging') }}</div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- =========================================================================
     2. PROOF OF WORK: LIVE IN-HOUSE SAAS PLATFORMS
     ========================================================================= --}}
<section id="proofs" class="py-20 sm:py-32 bg-white border-t border-slate-200/80 dark:bg-slate-900 dark:border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-16 sm:mb-20">
            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase text-indigo-700 bg-indigo-50 border border-indigo-100 mb-4 dark:text-indigo-300 dark:bg-indigo-500/10 dark:border-indigo-500/25">
                {{ __('saas.proofs.badge') }}
            </span>
            <h2 class="text-3xl sm:text-5xl font-extrabold text-slate-950 tracking-tight dark:text-white">
                {{ __('saas.proofs.title') }}
            </h2>
            <p class="mt-4 text-base sm:text-lg text-slate-600 dark:text-slate-400">
                {{ __('saas.proofs.subtitle') }}
            </p>
        </div>

        {{-- Proof Cards Grid --}}
        <div class="space-y-12 sm:space-y-16">

            {{-- 1. DigiPulse --}}
            <div class="rounded-3xl border border-slate-200/80 bg-slate-50/50 p-6 sm:p-10 lg:p-12 hover:border-slate-300 transition-all dark:border-slate-800 dark:bg-slate-950/40 dark:hover:border-slate-700">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    <div class="lg:col-span-7 space-y-6">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200/60 dark:bg-emerald-500/10 dark:text-emerald-300 dark:border-emerald-500/25">
                            <span class="size-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            {{ __('saas.proofs.projects.digipulse.badge') }}
                        </div>
                        <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-950 dark:text-white">
                            {{ __('saas.proofs.projects.digipulse.name') }}
                        </h3>
                        <p class="text-base sm:text-lg font-medium text-slate-700 dark:text-slate-300">
                            {{ __('saas.proofs.projects.digipulse.tagline') }}
                        </p>
                        <p class="text-sm sm:text-base text-slate-600 leading-relaxed dark:text-slate-400">
                            {{ __('saas.proofs.projects.digipulse.desc') }}
                        </p>

                        {{-- Tech Stack Tags --}}
                        <div class="flex flex-wrap gap-2 pt-2">
                            @foreach(__('saas.proofs.projects.digipulse.stack') as $tech)
                                <span class="px-2.5 py-1 rounded-md text-xs font-mono font-medium bg-white text-slate-700 border border-slate-200/80 shadow-2xs dark:bg-slate-900 dark:text-slate-300 dark:border-slate-800">
                                    {{ $tech }}
                                </span>
                            @endforeach
                        </div>

                        {{-- Actions --}}
                        <div class="pt-4 flex flex-wrap items-center gap-4">
                            <a href="{{ __('saas.proofs.projects.digipulse.live_url') }}" target="_blank" rel="noopener noreferrer"
                               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold text-white bg-slate-950 hover:bg-indigo-600 transition-colors shadow-xs dark:bg-white dark:text-slate-950 dark:hover:bg-indigo-500 dark:hover:text-white">
                                <span>{{ __('saas.proofs.view_live') }}</span>
                                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    {{-- Visual Architectural Block --}}
                    <div class="lg:col-span-5">
                        <div class="bg-slate-900 rounded-2xl p-5 sm:p-6 text-slate-100 font-mono text-xs shadow-lg border border-slate-800 space-y-4">
                            <div class="flex items-center justify-between border-b border-slate-800 pb-3 text-slate-400">
                                <div class="flex items-center gap-1.5">
                                    <span class="size-3 rounded-full bg-rose-500/80"></span>
                                    <span class="size-3 rounded-full bg-amber-500/80"></span>
                                    <span class="size-3 rounded-full bg-emerald-500/80"></span>
                                </div>
                                <span class="text-[11px] text-slate-400 font-sans font-semibold">digipulse-engine.go</span>
                            </div>
                            <div class="space-y-2 text-slate-300">
                                <p class="text-indigo-400">// Simplified: Go worker processing a check</p>
                                <p><span class="text-rose-400">func</span> <span class="text-blue-300">ProcessChecks</span>(ctx context.Context) {</p>
                                <p class="pl-4 text-slate-400">redis := rdb.Subscribe("checks:high-priority")</p>
                                <p class="pl-4 text-emerald-400">latency := worker.BenchmarkHTTP(target)</p>
                                <p class="pl-4 text-slate-300">if latency &gt; threshold {</p>
                                <p class="pl-8 text-amber-300">alert.DispatchTelegram(tenantId)</p>
                                <p class="pl-4 text-slate-300">}</p>
                                <p>}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. VetSpace & VetCard --}}
            <div class="rounded-3xl border border-slate-200/80 bg-slate-50/50 p-6 sm:p-10 lg:p-12 hover:border-slate-300 transition-all dark:border-slate-800 dark:bg-slate-950/40 dark:hover:border-slate-700">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    <div class="lg:col-span-7 space-y-6">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200/60 dark:bg-blue-500/10 dark:text-blue-300 dark:border-blue-500/25">
                            <span class="size-2 rounded-full bg-blue-500"></span>
                            {{ __('saas.proofs.projects.vetspace.badge') }}
                        </div>
                        <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-950 dark:text-white">
                            {{ __('saas.proofs.projects.vetspace.name') }}
                        </h3>
                        <p class="text-base sm:text-lg font-medium text-slate-700 dark:text-slate-300">
                            {{ __('saas.proofs.projects.vetspace.tagline') }}
                        </p>
                        <p class="text-sm sm:text-base text-slate-600 leading-relaxed dark:text-slate-400">
                            {{ __('saas.proofs.projects.vetspace.desc') }}
                        </p>

                        {{-- Tech Stack Tags --}}
                        <div class="flex flex-wrap gap-2 pt-2">
                            @foreach(__('saas.proofs.projects.vetspace.stack') as $tech)
                                <span class="px-2.5 py-1 rounded-md text-xs font-mono font-medium bg-white text-slate-700 border border-slate-200/80 shadow-2xs dark:bg-slate-900 dark:text-slate-300 dark:border-slate-800">
                                    {{ $tech }}
                                </span>
                            @endforeach
                        </div>

                        {{-- Actions --}}
                        <div class="pt-4 flex flex-wrap items-center gap-4">
                            <a href="{{ __('saas.proofs.projects.vetspace.live_url') }}" target="_blank" rel="noopener noreferrer"
                               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold text-white bg-slate-950 hover:bg-indigo-600 transition-colors shadow-xs dark:bg-white dark:text-slate-950 dark:hover:bg-indigo-500 dark:hover:text-white">
                                <span>{{ __('saas.proofs.view_live') }}</span>
                                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    {{-- Visual Mockup Block --}}
                    <div class="lg:col-span-5">
                        <div class="bg-white rounded-2xl p-6 border border-slate-200/90 shadow-md space-y-4 dark:bg-slate-900 dark:border-slate-800">
                            <div class="flex items-center justify-between pb-3 border-b border-slate-100 dark:border-slate-800">
                                <div class="flex items-center gap-2">
                                    <div class="size-8 rounded-lg bg-indigo-600 text-white font-bold flex items-center justify-center text-xs">V</div>
                                    <div>
                                        <div class="font-bold text-slate-900 text-xs dark:text-slate-100">clinic-central.vetspace.pro</div>
                                        <div class="text-[10px] text-emerald-600 font-semibold dark:text-emerald-400">{{ __('saas.proofs.projects.vetspace.mock.caption') }}</div>
                                    </div>
                                </div>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400">Stripe</span>
                            </div>
                            <ul class="space-y-2 text-xs">
                                @foreach(__('saas.proofs.projects.vetspace.mock.points') as $point)
                                    <li class="p-2.5 rounded-xl bg-slate-50 border border-slate-100 text-slate-700 flex items-center gap-2 dark:bg-slate-800 dark:border-slate-800 dark:text-slate-300">
                                        <svg class="size-4 text-indigo-600 shrink-0 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        <span>{{ $point }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3. NetPostPanel --}}
            <div class="rounded-3xl border border-slate-200/80 bg-slate-50/50 p-6 sm:p-10 lg:p-12 hover:border-slate-300 transition-all dark:border-slate-800 dark:bg-slate-950/40 dark:hover:border-slate-700">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    <div class="lg:col-span-7 space-y-6">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-purple-50 text-purple-700 border border-purple-200/60 dark:bg-purple-500/10 dark:text-purple-300 dark:border-purple-500/25">
                            <span class="size-2 rounded-full bg-purple-500"></span>
                            {{ __('saas.proofs.projects.netpostpanel.badge') }}
                        </div>
                        <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-950 dark:text-white">
                            {{ __('saas.proofs.projects.netpostpanel.name') }}
                        </h3>
                        <p class="text-base sm:text-lg font-medium text-slate-700 dark:text-slate-300">
                            {{ __('saas.proofs.projects.netpostpanel.tagline') }}
                        </p>
                        <p class="text-sm sm:text-base text-slate-600 leading-relaxed dark:text-slate-400">
                            {{ __('saas.proofs.projects.netpostpanel.desc') }}
                        </p>

                        {{-- Tech Stack Tags --}}
                        <div class="flex flex-wrap gap-2 pt-2">
                            @foreach(__('saas.proofs.projects.netpostpanel.stack') as $tech)
                                <span class="px-2.5 py-1 rounded-md text-xs font-mono font-medium bg-white text-slate-700 border border-slate-200/80 shadow-2xs dark:bg-slate-900 dark:text-slate-300 dark:border-slate-800">
                                    {{ $tech }}
                                </span>
                            @endforeach
                        </div>

                        {{-- Actions --}}
                        <div class="pt-4 flex flex-wrap items-center gap-4">
                            <a href="{{ __('saas.proofs.projects.netpostpanel.live_url') }}" target="_blank" rel="noopener noreferrer"
                               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold text-white bg-slate-950 hover:bg-indigo-600 transition-colors shadow-xs dark:bg-white dark:text-slate-950 dark:hover:bg-indigo-500 dark:hover:text-white">
                                <span>{{ __('saas.proofs.view_live') }}</span>
                                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    {{-- Visual AI Pipeline Block --}}
                    <div class="lg:col-span-5">
                        <div class="bg-slate-950 rounded-2xl p-5 border border-purple-900/40 text-xs font-mono space-y-3 shadow-xl">
                            <div class="flex items-center justify-between text-purple-300 pb-2 border-b border-slate-800">
                                <span class="font-bold flex items-center gap-1.5">
                                    <span class="size-2 rounded-full bg-purple-400 animate-ping"></span>
                                    RAG Vector Pipeline
                                </span>
                                <span class="text-[10px] text-slate-400">Qdrant + Langfuse</span>
                            </div>
                            <div class="space-y-2 text-slate-300">
                                <div class="p-2 rounded-lg bg-slate-900/90 border border-slate-800 flex items-center justify-between">
                                    <span class="text-slate-400">1. Web Scraping</span>
                                    <span class="text-emerald-400 font-bold">200 OK</span>
                                </div>
                                <div class="p-2 rounded-lg bg-slate-900/90 border border-slate-800 flex items-center justify-between">
                                    <span class="text-slate-400">2. Vector Embeddings</span>
                                    <span class="text-indigo-400 font-bold">1536 dims</span>
                                </div>
                                <div class="p-2 rounded-lg bg-slate-900/90 border border-slate-800 flex items-center justify-between">
                                    <span class="text-slate-400">3. Semantic Search (Qdrant)</span>
                                    <span class="text-purple-400 font-bold">top_k=5 cosine</span>
                                </div>
                                <div class="p-2 rounded-lg bg-slate-900/90 border border-slate-800 flex items-center justify-between">
                                    <span class="text-slate-400">4. LLM Synthesis & Tracing</span>
                                    <span class="text-amber-400 font-bold">Langfuse Tracked</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- =========================================================================
     3. THE SAAS ENGINE: 6 ARCHITECTURAL PILLARS (BENTO GRID)
     ========================================================================= --}}
<section id="engine" class="py-20 sm:py-32 bg-slate-50/70 border-t border-slate-200/80 dark:bg-slate-950 dark:border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-16 sm:mb-20">
            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase text-indigo-700 bg-indigo-50 border border-indigo-100 mb-4 dark:text-indigo-300 dark:bg-indigo-500/10 dark:border-indigo-500/25">
                {{ __('saas.engine.badge') }}
            </span>
            <h2 class="text-3xl sm:text-5xl font-extrabold text-slate-950 tracking-tight dark:text-white">
                {{ __('saas.engine.title') }}
            </h2>
            <p class="mt-4 text-base sm:text-lg text-slate-600 dark:text-slate-400">
                {{ __('saas.engine.subtitle') }}
            </p>
        </div>

        {{-- Bento Grid of 6 Pillars --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">

            {{-- 1. Multi-Tenancy --}}
            <div class="p-8 rounded-3xl bg-white border border-slate-200/80 hover:border-slate-300 hover:shadow-xs transition-all space-y-4 dark:bg-slate-900 dark:border-slate-800 dark:hover:border-slate-700">
                <div class="size-12 rounded-2xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 dark:bg-indigo-500/10 dark:border-indigo-500/25 dark:text-indigo-400">
                    <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400">
                    {{ __('saas.engine.pillars.multitenancy.tag') }}
                </span>
                <h3 class="text-xl font-bold text-slate-950 dark:text-white">
                    {{ __('saas.engine.pillars.multitenancy.title') }}
                </h3>
                <p class="text-sm text-slate-600 leading-relaxed dark:text-slate-400">
                    {{ __('saas.engine.pillars.multitenancy.desc') }}
                </p>
            </div>

            {{-- 2. Stripe Subscriptions --}}
            <div class="p-8 rounded-3xl bg-white border border-slate-200/80 hover:border-slate-300 hover:shadow-xs transition-all space-y-4 dark:bg-slate-900 dark:border-slate-800 dark:hover:border-slate-700">
                <div class="size-12 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 dark:bg-emerald-500/10 dark:border-emerald-500/25 dark:text-emerald-400">
                    <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </div>
                <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300">
                    {{ __('saas.engine.pillars.billing.tag') }}
                </span>
                <h3 class="text-xl font-bold text-slate-950 dark:text-white">
                    {{ __('saas.engine.pillars.billing.title') }}
                </h3>
                <p class="text-sm text-slate-600 leading-relaxed dark:text-slate-400">
                    {{ __('saas.engine.pillars.billing.desc') }}
                </p>
            </div>

            {{-- 3. Queues & Workers --}}
            <div class="p-8 rounded-3xl bg-white border border-slate-200/80 hover:border-slate-300 hover:shadow-xs transition-all space-y-4 dark:bg-slate-900 dark:border-slate-800 dark:hover:border-slate-700">
                <div class="size-12 rounded-2xl bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600 dark:bg-blue-500/10 dark:border-blue-500/25 dark:text-blue-400">
                    <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 dark:bg-blue-500/10 dark:text-blue-300">
                    {{ __('saas.engine.pillars.workers.tag') }}
                </span>
                <h3 class="text-xl font-bold text-slate-950 dark:text-white">
                    {{ __('saas.engine.pillars.workers.title') }}
                </h3>
                <p class="text-sm text-slate-600 leading-relaxed dark:text-slate-400">
                    {{ __('saas.engine.pillars.workers.desc') }}
                </p>
            </div>

            {{-- 4. Filament Admin --}}
            <div class="p-8 rounded-3xl bg-white border border-slate-200/80 hover:border-slate-300 hover:shadow-xs transition-all space-y-4 dark:bg-slate-900 dark:border-slate-800 dark:hover:border-slate-700">
                <div class="size-12 rounded-2xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600 dark:bg-amber-500/10 dark:border-amber-500/25 dark:text-amber-400">
                    <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                </div>
                <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 dark:bg-amber-500/10 dark:text-amber-300">
                    {{ __('saas.engine.pillars.admin.tag') }}
                </span>
                <h3 class="text-xl font-bold text-slate-950 dark:text-white">
                    {{ __('saas.engine.pillars.admin.title') }}
                </h3>
                <p class="text-sm text-slate-600 leading-relaxed dark:text-slate-400">
                    {{ __('saas.engine.pillars.admin.desc') }}
                </p>
            </div>

            {{-- 5. AI / RAG Context --}}
            <div class="p-8 rounded-3xl bg-white border border-slate-200/80 hover:border-slate-300 hover:shadow-xs transition-all space-y-4 dark:bg-slate-900 dark:border-slate-800 dark:hover:border-slate-700">
                <div class="size-12 rounded-2xl bg-purple-50 border border-purple-100 flex items-center justify-center text-purple-600 dark:bg-purple-500/10 dark:border-purple-500/25 dark:text-purple-400">
                    <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
                <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold bg-purple-50 text-purple-700 dark:bg-purple-500/10 dark:text-purple-300">
                    {{ __('saas.engine.pillars.ai.tag') }}
                </span>
                <h3 class="text-xl font-bold text-slate-950 dark:text-white">
                    {{ __('saas.engine.pillars.ai.title') }}
                </h3>
                <p class="text-sm text-slate-600 leading-relaxed dark:text-slate-400">
                    {{ __('saas.engine.pillars.ai.desc') }}
                </p>
            </div>

            {{-- 6. Docker & Cloud --}}
            <div class="p-8 rounded-3xl bg-white border border-slate-200/80 hover:border-slate-300 hover:shadow-xs transition-all space-y-4 dark:bg-slate-900 dark:border-slate-800 dark:hover:border-slate-700">
                <div class="size-12 rounded-2xl bg-cyan-50 border border-cyan-100 flex items-center justify-center text-cyan-600 dark:bg-cyan-500/10 dark:border-cyan-500/25 dark:text-cyan-400">
                    <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 100-6 3 3 0 000 6z"/>
                    </svg>
                </div>
                <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold bg-cyan-50 text-cyan-800 dark:bg-cyan-500/10 dark:text-cyan-300">
                    {{ __('saas.engine.pillars.devops.tag') }}
                </span>
                <h3 class="text-xl font-bold text-slate-950 dark:text-white">
                    {{ __('saas.engine.pillars.devops.title') }}
                </h3>
                <p class="text-sm text-slate-600 leading-relaxed dark:text-slate-400">
                    {{ __('saas.engine.pillars.devops.desc') }}
                </p>
            </div>

        </div>
    </div>
</section>


{{-- =========================================================================
     4. ENGINEERING STANDARDS & COMPARISON (DIGISPACE VS AGENCY)
     ========================================================================= --}}
<section id="guarantees" class="py-20 sm:py-32 bg-white border-t border-slate-200/80 dark:bg-slate-900 dark:border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-16 sm:mb-20">
            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase text-indigo-700 bg-indigo-50 border border-indigo-100 mb-4 dark:text-indigo-300 dark:bg-indigo-500/10 dark:border-indigo-500/25">
                {{ __('saas.guarantees.badge') }}
            </span>
            <h2 class="text-3xl sm:text-5xl font-extrabold text-slate-950 tracking-tight dark:text-white">
                {{ __('saas.guarantees.title') }}
            </h2>
            <p class="mt-4 text-base sm:text-lg text-slate-600 dark:text-slate-400">
                {{ __('saas.guarantees.subtitle') }}
            </p>
        </div>

        {{-- 4 Pillars of Guarantee Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-24">
            @foreach(['staging', 'testing', 'ownership', 'direct'] as $key)
                <div class="p-8 rounded-3xl bg-slate-50/60 border border-slate-200/80 hover:border-slate-300 transition-all space-y-3 dark:bg-slate-950/40 dark:border-slate-800 dark:hover:border-slate-700">
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-white text-slate-900 border border-slate-200/80 shadow-2xs dark:bg-slate-900 dark:text-slate-100 dark:border-slate-800">
                        {{ __('saas.guarantees.items.' . $key . '.badge') }}
                    </span>
                    <h3 class="text-xl font-extrabold text-slate-950 pt-2 dark:text-white">
                        {{ __('saas.guarantees.items.' . $key . '.title') }}
                    </h3>
                    <p class="text-sm sm:text-base text-slate-600 leading-relaxed dark:text-slate-400">
                        {{ __('saas.guarantees.items.' . $key . '.desc') }}
                    </p>
                </div>
            @endforeach
        </div>

        {{-- Comparison Table: DigiSpace vs Traditional Software House --}}
        <div class="mt-16">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase text-slate-600 bg-slate-100 border border-slate-200 mb-3 dark:text-slate-400 dark:bg-slate-800 dark:border-slate-800">
                    {{ __('saas.comparison.badge') }}
                </span>
                <h3 class="text-2xl sm:text-4xl font-extrabold text-slate-950 dark:text-white">
                    {{ __('saas.comparison.title') }}
                </h3>
                <p class="mt-2 text-sm sm:text-base text-slate-500 dark:text-slate-400">
                    {{ __('saas.comparison.subtitle') }}
                </p>
            </div>

            {{-- Desktop Table View --}}
            <div class="hidden md:block overflow-hidden rounded-3xl border border-slate-200/80 shadow-xs dark:border-slate-800">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200/80 text-xs font-bold uppercase tracking-wider text-slate-500 dark:bg-slate-800 dark:border-slate-800 dark:text-slate-400">
                            <th class="py-5 px-6">{{ __('saas.comparison.headers.feature') }}</th>
                            <th class="py-5 px-6 text-slate-400 font-medium">{{ __('saas.comparison.headers.software_house') }}</th>
                            <th class="py-5 px-6 bg-indigo-50/60 text-indigo-950 font-extrabold border-l border-indigo-100 dark:bg-indigo-500/10 dark:text-indigo-300 dark:border-indigo-500/25">
                                <span class="flex items-center gap-1.5">
                                    <span class="size-2 rounded-full bg-indigo-600"></span>
                                    {{ __('saas.comparison.headers.digispace') }}
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200/70 text-sm dark:divide-slate-800">
                        @foreach(['team', 'timeline', 'cost', 'staging', 'testing', 'ownership'] as $row)
                            <tr class="hover:bg-slate-50/50 transition-colors dark:hover:bg-slate-950/40">
                                <td class="py-5 px-6 font-bold text-slate-900 w-1/4 dark:text-slate-100">
                                    {{ __('saas.comparison.rows.' . $row . '.label') }}
                                </td>
                                <td class="py-5 px-6 text-slate-500 w-3/8 dark:text-slate-400">
                                    <span class="inline-flex items-center gap-2">
                                        <span class="size-1.5 rounded-full bg-slate-300 dark:bg-slate-600 shrink-0" aria-hidden="true"></span>
                                        {{ __('saas.comparison.rows.' . $row . '.agency') }}
                                    </span>
                                </td>
                                <td class="py-5 px-6 bg-indigo-50/30 font-semibold text-slate-950 border-l border-indigo-100 w-3/8 dark:bg-indigo-500/10 dark:text-white dark:border-indigo-500/25">
                                    <span class="inline-flex items-center gap-2">
                                        <svg class="size-4 text-emerald-600 shrink-0 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        {{ __('saas.comparison.rows.' . $row . '.us') }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Mobile Cards View --}}
            <div class="md:hidden space-y-4">
                @foreach(['team', 'timeline', 'cost', 'staging', 'testing', 'ownership'] as $row)
                    <div class="p-5 rounded-2xl border border-slate-200 bg-white space-y-3 shadow-2xs dark:border-slate-800 dark:bg-slate-900">
                        <div class="font-bold text-slate-950 text-sm border-b border-slate-100 pb-2 dark:text-white dark:border-slate-800">
                            {{ __('saas.comparison.rows.' . $row . '.label') }}
                        </div>
                        <div class="text-xs text-slate-500 flex items-start gap-2 dark:text-slate-400">
                            <span class="mt-1.5 size-1.5 rounded-full bg-slate-300 dark:bg-slate-600 shrink-0" aria-hidden="true"></span>
                            <span>{{ __('saas.comparison.rows.' . $row . '.agency') }}</span>
                        </div>
                        <div class="text-xs font-semibold text-slate-950 flex items-start gap-2 p-2.5 rounded-xl bg-indigo-50/60 border border-indigo-100 dark:text-white dark:bg-indigo-500/10 dark:border-indigo-500/25">
                            <span class="text-emerald-600 font-bold dark:text-emerald-400">✓</span>
                            <span>{{ __('saas.comparison.rows.' . $row . '.us') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


{{-- =========================================================================
     5. 4-SPRINT LAUNCH ROADMAP
     ========================================================================= --}}
<section id="process" class="py-20 sm:py-32 bg-slate-50/70 border-t border-slate-200/80 dark:bg-slate-950 dark:border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-16 sm:mb-20">
            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase text-indigo-700 bg-indigo-50 border border-indigo-100 mb-4 dark:text-indigo-300 dark:bg-indigo-500/10 dark:border-indigo-500/25">
                {{ __('saas.process.badge') }}
            </span>
            <h2 class="text-3xl sm:text-5xl font-extrabold text-slate-950 tracking-tight dark:text-white">
                {{ __('saas.process.title') }}
            </h2>
            <p class="mt-4 text-base sm:text-lg text-slate-600 dark:text-slate-400">
                {{ __('saas.process.subtitle') }}
            </p>
        </div>

        {{-- Sprints Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach(['s1', 's2', 's3', 's4'] as $sprint)
                <div class="p-8 sm:p-10 rounded-3xl bg-white border border-slate-200/80 hover:border-slate-300 shadow-xs transition-all space-y-6 flex flex-col justify-between dark:bg-slate-900 dark:border-slate-800 dark:hover:border-slate-700">
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="text-3xl sm:text-4xl font-black text-slate-200 font-mono dark:text-slate-700">
                                {{ __('saas.process.sprints.' . $sprint . '.number') }}
                            </span>
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-100 dark:bg-indigo-500/10 dark:text-indigo-300 dark:border-indigo-500/25">
                                {{ __('saas.process.sprints.' . $sprint . '.duration') }}
                            </span>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-extrabold text-slate-950 mt-4 dark:text-white">
                            {{ __('saas.process.sprints.' . $sprint . '.name') }}
                        </h3>
                        <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">
                            {{ __('saas.process.sprints.' . $sprint . '.desc') }}
                        </p>
                    </div>

                    {{-- Deliverables Checklist --}}
                    <div class="pt-4 border-t border-slate-100 space-y-2.5 dark:border-slate-800">
                        @foreach(__('saas.process.sprints.' . $sprint . '.deliverables') as $deliverable)
                            <div class="flex items-start gap-2.5 text-xs sm:text-sm text-slate-700 dark:text-slate-300">
                                <svg class="size-4 text-emerald-600 shrink-0 mt-0.5 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span>{{ $deliverable }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


{{-- =========================================================================
     6. PRICING & ENGAGEMENT MODELS
     ========================================================================= --}}
<section id="pricing" class="py-20 sm:py-32 bg-white border-t border-slate-200/80 dark:bg-slate-900 dark:border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-16 sm:mb-20">
            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase text-indigo-700 bg-indigo-50 border border-indigo-100 mb-4 dark:text-indigo-300 dark:bg-indigo-500/10 dark:border-indigo-500/25">
                {{ __('saas.pricing.badge') }}
            </span>
            <h2 class="text-3xl sm:text-5xl font-extrabold text-slate-950 tracking-tight dark:text-white">
                {{ __('saas.pricing.title') }}
            </h2>
            <p class="mt-4 text-base sm:text-lg text-slate-600 dark:text-slate-400">
                {{ __('saas.pricing.subtitle') }}
            </p>
        </div>

        {{-- 2 Cards Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-5xl mx-auto items-stretch">

            {{-- Plan 1: SaaS MVP Sprint (Featured) --}}
            <div class="p-8 sm:p-10 rounded-3xl bg-slate-950 text-white border-2 border-indigo-500 shadow-xl flex flex-col justify-between relative overflow-hidden">
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <span class="px-3.5 py-1 rounded-full text-xs font-extrabold bg-indigo-600 text-white">
                            {{ __('saas.pricing.plans.mvp.badge') }}
                        </span>
                        <span class="text-xs font-medium text-slate-400">
                            {{ __('saas.pricing.plans.mvp.timeline') }}
                        </span>
                    </div>

                    <div>
                        <h3 class="text-2xl sm:text-3xl font-extrabold">
                            {{ __('saas.pricing.plans.mvp.name') }}
                        </h3>
                        <p class="mt-2 text-sm text-slate-300 leading-relaxed">
                            {{ __('saas.pricing.plans.mvp.desc') }}
                        </p>
                    </div>

                    <div class="py-4 border-y border-slate-800">
                        <div class="text-3xl sm:text-4xl font-black text-white">
                            {{ __('saas.pricing.plans.mvp.price') }}
                        </div>
                        <div class="text-xs text-slate-400 mt-1">
                            {{ __('saas.pricing.plans.mvp.price_sub') }}
                        </div>
                    </div>

                    {{-- Features List --}}
                    <div class="space-y-3 pt-2">
                        @foreach(__('saas.pricing.plans.mvp.features') as $feature)
                            <div class="flex items-start gap-2.5 text-xs sm:text-sm text-slate-200">
                                <svg class="size-4 text-emerald-400 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span>{{ $feature }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-8 pt-6">
                    <a href="#contact" class="w-full inline-flex items-center justify-center gap-2 px-6 py-4 rounded-xl text-base font-bold text-slate-950 bg-white hover:bg-indigo-50 transition-colors shadow-sm">
                        <span>{{ __('saas.pricing.plans.mvp.cta') }}</span>
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Plan 2: Fractional CTO Retainer --}}
            <div class="p-8 sm:p-10 rounded-3xl bg-white border border-slate-200/90 shadow-sm flex flex-col justify-between hover:border-slate-300 transition-all dark:bg-slate-900 dark:border-slate-800 dark:hover:border-slate-700">
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                            {{ __('saas.pricing.plans.retainer.badge') }}
                        </span>
                        <span class="text-xs font-medium text-slate-500 dark:text-slate-400">
                            {{ __('saas.pricing.plans.retainer.timeline') }}
                        </span>
                    </div>

                    <div>
                        <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-950 dark:text-white">
                            {{ __('saas.pricing.plans.retainer.name') }}
                        </h3>
                        <p class="mt-2 text-sm text-slate-600 leading-relaxed dark:text-slate-400">
                            {{ __('saas.pricing.plans.retainer.desc') }}
                        </p>
                    </div>

                    <div class="py-4 border-y border-slate-100 dark:border-slate-800">
                        <div class="text-3xl sm:text-4xl font-black text-slate-950 dark:text-white">
                            {{ __('saas.pricing.plans.retainer.price') }}
                        </div>
                        <div class="text-xs text-slate-500 mt-1 dark:text-slate-400">
                            {{ __('saas.pricing.plans.retainer.price_sub') }}
                        </div>
                    </div>

                    {{-- Features List --}}
                    <div class="space-y-3 pt-2">
                        @foreach(__('saas.pricing.plans.retainer.features') as $feature)
                            <div class="flex items-start gap-2.5 text-xs sm:text-sm text-slate-700 dark:text-slate-300">
                                <svg class="size-4 text-indigo-600 shrink-0 mt-0.5 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span>{{ $feature }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-8 pt-6">
                    <a href="https://t.me/YuriiMokryi" target="_blank" rel="noopener noreferrer"
                       class="w-full inline-flex items-center justify-center gap-2 px-6 py-4 rounded-xl text-base font-bold text-white bg-slate-950 hover:bg-indigo-600 transition-colors shadow-sm dark:bg-white dark:text-slate-950 dark:hover:bg-indigo-500 dark:hover:text-white">
                        <span>{{ __('saas.pricing.plans.retainer.cta') }}</span>
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- =========================================================================
     7. SOCIAL PROOF (UPWORK + LINKEDIN EXCERPTS)
     ========================================================================= --}}
<section class="pb-20 sm:pb-28 bg-white dark:bg-slate-900">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="mb-6 text-center text-xs font-bold tracking-wider uppercase text-slate-500 dark:text-slate-400">
            {{ __('saas.social_proof.badge') }}
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
            @foreach(__('saas.social_proof.items') as $review)
                <figure class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-950/40 border border-slate-200/80 dark:border-slate-800 flex flex-col justify-between gap-4">
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
</section>


{{-- =========================================================================
     8. FREQUENTLY ASKED QUESTIONS (ACCORDION)
     ========================================================================= --}}
<section id="faq" class="py-20 sm:py-32 bg-slate-50/70 border-t border-slate-200/80 dark:bg-slate-950 dark:border-slate-800">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="text-center mb-16 sm:mb-20">
            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase text-indigo-700 bg-indigo-50 border border-indigo-100 mb-4 dark:text-indigo-300 dark:bg-indigo-500/10 dark:border-indigo-500/25">
                {{ __('saas.faq.badge') }}
            </span>
            <h2 class="text-3xl sm:text-5xl font-extrabold text-slate-950 tracking-tight dark:text-white">
                {{ __('saas.faq.title') }}
            </h2>
            <p class="mt-4 text-base sm:text-lg text-slate-600 dark:text-slate-400">
                {{ __('saas.faq.subtitle') }}
            </p>
        </div>

        {{-- Accordion Items --}}
        <div class="space-y-4">
            @foreach(['q1', 'q2', 'q3', 'q4', 'q5', 'q6', 'q7'] as $q)
                <details class="group bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-7 transition-all [&_summary::-webkit-details-marker]:hidden open:shadow-xs dark:bg-slate-900 dark:border-slate-800">
                    <summary class="flex items-center justify-between cursor-pointer list-none gap-4">
                        <h3 class="font-bold text-slate-900 text-base sm:text-lg select-none dark:text-slate-100">
                            {{ __('saas.faq.items.' . $q . '.q') }}
                        </h3>
                        <span class="size-8 rounded-full bg-slate-100 group-open:bg-indigo-50 group-open:text-indigo-600 text-slate-500 flex items-center justify-center shrink-0 transition-transform duration-200 group-open:rotate-180 dark:bg-slate-800 dark:group-open:bg-indigo-500/10 dark:group-open:text-indigo-400 dark:text-slate-400">
                            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </span>
                    </summary>
                    <p class="mt-4 text-sm sm:text-base text-slate-600 leading-relaxed border-t border-slate-100 pt-4 dark:text-slate-400 dark:border-slate-800">
                        {{ __('saas.faq.items.' . $q . '.a') }}
                    </p>
                </details>
            @endforeach
        </div>
    </div>
</section>


{{-- =========================================================================
     9. PROJECT QUALIFICATION & INQUIRY FORM
     ========================================================================= --}}
<section id="contact" class="py-20 sm:py-32 bg-white border-t border-slate-200/80 dark:bg-slate-900 dark:border-slate-800">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-16 sm:mb-20">
            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase text-indigo-700 bg-indigo-50 border border-indigo-100 mb-4 dark:text-indigo-300 dark:bg-indigo-500/10 dark:border-indigo-500/25">
                {{ __('saas.contact.badge') }}
            </span>
            <h2 class="text-3xl sm:text-5xl font-extrabold text-slate-950 tracking-tight dark:text-white">
                {{ __('saas.contact.title') }}
            </h2>
            <p class="mt-4 text-base sm:text-lg text-slate-600 dark:text-slate-400">
                {{ __('saas.contact.subtitle') }}
            </p>
        </div>

        {{-- Direct Action Bar: Telegram & Email --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-12">
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
                            {{ __('saas.contact.telegram_cta') }}
                        </div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">
                            {{ __('saas.contact.telegram_hint') }}
                        </div>
                    </div>
                </div>
                <span class="text-slate-400 group-hover:text-indigo-600 group-hover:translate-x-1 transition-all dark:group-hover:text-indigo-400">→</span>
            </a>

            <a href="mailto:admin@digispace.pro?subject=SaaS%20MVP%20Inquiry"
               class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 hover:bg-slate-100/70 transition-all flex items-center justify-between group dark:bg-slate-800 dark:border-slate-800 dark:hover:bg-slate-800/70">
                <div class="flex items-center gap-3.5">
                    <div class="size-11 rounded-xl bg-slate-950 text-white flex items-center justify-center shrink-0 dark:bg-white dark:text-slate-950">
                        <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-extrabold text-slate-900 text-sm group-hover:text-slate-950 transition-colors dark:text-slate-100 dark:group-hover:text-white">
                            {{ __('saas.contact.email_cta') }}
                        </div>
                        <div class="text-xs text-slate-500 font-mono dark:text-slate-400">
                            admin@digispace.pro
                        </div>
                    </div>
                </div>
                <span class="text-slate-400 group-hover:text-slate-950 group-hover:translate-x-1 transition-all dark:group-hover:text-white">→</span>
            </a>
        </div>

        {{-- Form Container --}}
        <div class="bg-slate-50/70 rounded-3xl border border-slate-200/80 p-8 sm:p-12 shadow-xs dark:bg-slate-950 dark:border-slate-800">
            @if(session('saas_success'))
                <div class="p-6 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 mb-8 space-y-2 dark:bg-emerald-500/10 dark:border-emerald-500/25 dark:text-emerald-300">
                    <div class="flex items-center gap-2 font-bold text-base text-emerald-950 dark:text-emerald-300">
                        <svg class="size-5 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>{{ __('saas.contact.form.success_title') }}</span>
                    </div>
                    <p class="text-sm text-emerald-800 dark:text-emerald-300">
                        {{ __('saas.contact.form.success_message') }}
                    </p>
                </div>
            @endif

            @if($errors->any())
                <div class="p-5 rounded-2xl bg-rose-50 border border-rose-200 text-rose-900 text-sm mb-6 space-y-1 dark:bg-rose-500/10 dark:border-rose-500/25 dark:text-rose-300">
                    <div class="font-bold">{{ __('saas.contact.form.errors_title') }}</div>
                    <ul class="list-disc pl-5 text-xs text-rose-800 space-y-1 dark:text-rose-300">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('development.saas.inquiry', ['locale' => app()->getLocale()]) }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    {{-- Project Name --}}
                    <div>
                        <label for="project_name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2 dark:text-slate-300">
                            {{ __('saas.contact.form.project_name') }} <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="project_name" name="project_name" value="{{ old('project_name') }}" required
                               placeholder="{{ __('saas.contact.form.project_name_placeholder') }}"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all dark:border-slate-800 dark:bg-slate-900 dark:text-slate-100">
                    </div>

                    {{-- Telegram / Email Contact --}}
                    <div>
                        <label for="contact_handle" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2 dark:text-slate-300">
                            {{ __('saas.contact.form.contact') }} <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="contact_handle" name="contact" value="{{ old('contact') }}" required
                               placeholder="{{ __('saas.contact.form.contact_placeholder') }}"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all dark:border-slate-800 dark:bg-slate-900 dark:text-slate-100">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    {{-- Project Stage --}}
                    <div>
                        <label for="stage" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2 dark:text-slate-300">
                            {{ __('saas.contact.form.stage') }}
                        </label>
                        <select id="stage" name="stage"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all dark:border-slate-800 dark:bg-slate-900 dark:text-slate-100">
                            <option value="">{{ __('saas.contact.form.not_specified') }}</option>
                            @foreach(__('saas.contact.form.stage_options') as $key => $label)
                                <option value="{{ $key }}" {{ old('stage') === $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Target Budget --}}
                    <div>
                        <label for="budget" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2 dark:text-slate-300">
                            {{ __('saas.contact.form.budget') }}
                        </label>
                        <select id="budget" name="budget"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all dark:border-slate-800 dark:bg-slate-900 dark:text-slate-100">
                            <option value="">{{ __('saas.contact.form.not_specified') }}</option>
                            @foreach(__('saas.contact.form.budget_options') as $key => $label)
                                <option value="{{ $key }}" {{ old('budget') === $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2 dark:text-slate-300">
                        {{ __('saas.contact.form.description') }} <span class="text-rose-500">*</span>
                    </label>
                    <textarea id="description" name="description" rows="4" required
                              placeholder="{{ __('saas.contact.form.description_placeholder') }}"
                              class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all dark:border-slate-800 dark:bg-slate-900 dark:text-slate-100">{{ old('description') }}</textarea>
                </div>

                {{-- reCAPTCHA (theme follows the page theme at render time) --}}
                <div>
                    <div class="g-recaptcha" data-size="normal" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                </div>

                {{-- Submit Button --}}
                <div>
                    <button type="submit"
                            class="w-full sm:w-auto px-8 py-4 rounded-xl text-base font-bold text-white bg-slate-950 hover:bg-indigo-600 transition-all shadow-sm hover:shadow-md cursor-pointer flex items-center justify-center gap-2 dark:bg-white dark:text-slate-950 dark:hover:bg-indigo-500 dark:hover:text-white">
                        <span>{{ __('saas.contact.form.submit') }}</span>
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.g-recaptcha').forEach(function (widget) {
            widget.setAttribute('data-theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
        });
    </script>
    <script src="https://www.google.com/recaptcha/api.js?hl={{ app()->getLocale() }}" async defer></script>
@endpush
