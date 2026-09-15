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
    <div class="site-language-control">
        <select aria-label="{{ __('site.language') }}" onchange="window.location.assign(this.value)">
            @foreach ($localeLinks as $locale => $url)
                <option value="{{ $url }}" lang="{{ $locale }}" title="{{ config('locales.labels.'.$locale, $locale) }}" @selected($locale === $currentLocale)>
                    {{ config('locales.short_labels.'.$locale, strtoupper($locale)) }}
                </option>
            @endforeach
        </select>
        <noscript>
            <ul class="site-language-control__links" aria-label="{{ __('site.language') }}">
                @foreach ($localeLinks as $locale => $url)
                    <li>
                        <a href="{{ $url }}" hreflang="{{ $locale }}" lang="{{ $locale }}" @if($locale === $currentLocale) aria-current="true" @endif>
                            {{ config('locales.short_labels.'.$locale, strtoupper($locale)) }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </noscript>
    </div>
@endif
