@php
    $routeName = request()->route()?->getName();
    $routeParameters = request()->route()?->parameters() ?? [];
    unset($routeParameters['locale']);
    $currentLocale = app()->getLocale();
@endphp

@if ($routeName && in_array($routeName, config('locales.route_names', []), true))
    <div class="site-language-control">
        <select aria-label="{{ __('site.language') }}" onchange="window.location.assign(this.value)">
            @foreach (config('locales.supported', []) as $locale)
                <option value="{{ route($routeName, array_merge(request()->query(), $routeParameters, ['locale' => $locale])) }}" @selected($locale === $currentLocale)>
                    {{ strtoupper($locale === 'uk' ? 'ua' : $locale) }}
                </option>
            @endforeach
        </select>
    </div>
@endif
@once
        <style>
            .rd-navbar-static.rd-navbar-classic .rd-navbar-aside > .site-header-actions { display:flex; align-items:center; gap:12px; flex-shrink:0; }
            .site-language-control select { width:72px; height:36px; padding:0 8px; border:1px solid #eaeced; border-radius:6px; background:#fff; color:#151515; font:600 13px Arial,sans-serif; cursor:pointer; }
            .site-language-control select:focus-visible { outline:2px solid #00a9ff; outline-offset:2px; }
            .rd-navbar-static.rd-navbar-classic .rd-navbar-aside { flex-wrap:nowrap; gap:16px; }
            .rd-navbar-static .rd-navbar-content-outer { min-width:0; }
            .rd-navbar-fixed .rd-navbar-brand .brand img { width:130px !important; max-width:130px !important; height:auto; }
            @media(max-width:360px) { .rd-navbar-fixed .rd-navbar-brand .brand img { width:100px !important; max-width:100px !important; } }
            .site-language-control .select2-container { width:72px !important; }
            .site-language-control .select2-choice { min-height:36px; padding:0 8px; }
            .rd-navbar-fixed .site-language-control { position:fixed; top:10px; right:104px; z-index:1002; }
        </style>
@endonce
