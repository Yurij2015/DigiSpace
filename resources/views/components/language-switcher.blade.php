@php
    $currentRoute = request()->route();
    $routeName = $currentRoute?->getName();
    $routeParameters = $currentRoute?->parameters() ?? [];
    unset($routeParameters['locale']);
    $currentLocale = app()->getLocale();

    if ($routeName && in_array($routeName, config('locales.route_names', []), true)) {
        $targetRoute = $routeName;
        $targetParameters = array_merge(request()->query(), $routeParameters);
    } elseif ($currentRoute?->isFallback) {
        // Branded 404: there is no localized counterpart, offer the home page per locale.
        $targetRoute = 'home.index';
        $targetParameters = [];
    } else {
        $targetRoute = null;
        $targetParameters = [];
    }

    $localeLinks = $targetRoute
        ? collect(config('locales.supported', []))->mapWithKeys(fn (string $locale) => [
            $locale => route($targetRoute, array_merge($targetParameters, ['locale' => $locale])),
        ])
        : collect();
@endphp

@if ($localeLinks->isNotEmpty())
    @php
        $currentLabel = config('locales.labels.'.$currentLocale, $currentLocale);
        $currentCode = config('locales.short_labels.'.$currentLocale, strtoupper($currentLocale));
    @endphp
    {{-- <details>/<summary>: works without JS, options are real links (no on-input context change, crawlable). --}}
    <div {{ $attributes->class(['site-language-control']) }}>
        <details class="site-language-control__menu">
            <summary class="site-language-control__toggle" aria-label="{{ __('site.language') }}: {{ $currentLabel }}">
                <svg class="site-language-control__icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                    <circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                </svg>
                <span class="site-language-control__current" lang="{{ $currentLocale }}">{{ $currentLabel }}</span>
                <span class="site-language-control__code" aria-hidden="true">{{ $currentCode }}</span>
                <svg class="site-language-control__caret" width="10" height="10" viewBox="0 0 10 10" aria-hidden="true" focusable="false"><path d="M1 3l4 4 4-4" fill="none" stroke="currentColor" stroke-width="1.5"/></svg>
            </summary>
            <ul class="site-language-control__list">
                @foreach ($localeLinks as $locale => $url)
                    <li>
                        <a href="{{ $url }}" hreflang="{{ $locale }}" lang="{{ $locale }}"{!! $locale === $currentLocale ? ' aria-current="true"' : '' !!}>{{ config('locales.labels.'.$locale, $locale) }}</a>
                    </li>
                @endforeach
            </ul>
        </details>
    </div>
@endif
