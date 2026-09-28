@php use App\Support\SeoMeta; @endphp
    <!DOCTYPE html>
<html class="wide wow-animation" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @php
        $localizedRouteNames = config('locales.route_names', []);
        $currentRouteName = Route::currentRouteName();
        $currentRouteParameters = request()->route()?->parameters() ?? [];
        unset($currentRouteParameters['locale']);

        extract(SeoMeta::resolve([
            'post' => $post ?? null,
            'page' => $page ?? null,
            'service' => $service ?? null,
            'serviceCategory' => $serviceCategory ?? null,
            'category' => $category ?? null,
            'archive' => $archive ?? null,
            'pageImage' => $pageImage ?? null,
            'headerNavBarContent' => $headerNavBarContent ?? null,
        ], $currentRouteName, $__env->yieldContent('title', __('site.default_title'))));
    @endphp
    <!-- Site Title-->
    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ Str::limit($metaDescription, 157) }}">
    @if($__env->yieldContent('robots') === 'noindex' || request()->routeIs('blog-search', 'service-search', 'error-404'))
        <meta name="robots" content="noindex">
    @endif
    @if(in_array($currentRouteName, $localizedRouteNames, true))
        <link rel="canonical"
              href="{{ route($currentRouteName, array_merge(['locale' => app()->getLocale()], $currentRouteParameters), true) }}">
        @foreach(config('locales.supported') as $alternateLocale)
            <link rel="alternate" hreflang="{{ $alternateLocale }}"
                  href="{{ route($currentRouteName, array_merge(['locale' => $alternateLocale], $currentRouteParameters), true) }}">
        @endforeach
        <link rel="alternate" hreflang="x-default"
              href="{{ route($currentRouteName, array_merge(['locale' => config('locales.default')], $currentRouteParameters), true) }}">
    @endif
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <!--  Facebook Open Graph-->
    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta property="og:type" content="{{ $seoPost !== null ? 'article' : 'website' }}"/>
    <meta property="og:title" content="{{ $ogTitle }}"/>
    <meta property="og:description" content="{{ Str::limit($metaDescription, 200) }}"/>
    <meta property="og:image" content="{{ $ogImage }}"/>
    <meta property="og:image:width" content="1200"/>
    <meta property="og:image:height" content="630"/>
    <meta property="og:site_name" content="{{ config('app.name') }}"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:title" content="{{ $ogTitle }}"/>
    <meta name="twitter:description" content="{{ Str::limit($metaDescription, 200) }}"/>
    <meta name="twitter:image" content="{{ $ogImage }}"/>
    <script
        type="application/ld+json">{!! json_encode($jsonLd, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}</script>
    @if($seoPost !== null)
        <meta name="keywords" content="{{ $seoPost->name }}"/>
    @elseif($seoPage !== null)
        <meta name="keywords" content="{{ $seoPage->meta }}"/>
    @elseif($seoService !== null)
        <meta name="keywords" content="{{ $seoService->seo_keywords }}"/>
    @elseif($seoCategory !== null)
        <meta name="keywords" content="{{ $seoCategory->seo_keywords }}"/>
    @endif
    <link rel="alternate icon" href="{{ asset('favicons/digispace-d.ico') }}?v={{ filemtime(public_path('favicons/digispace-d.ico')) }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicons/digispace-d.svg') }}?v={{ filemtime(public_path('favicons/digispace-d.svg')) }}" type="image/svg+xml">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lato:400,700%7CSpace+Mono">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cookie-consent.css') }}?v={{ filemtime(public_path('css/cookie-consent.css')) }}">

    @include('partials.tracking.consent-mode')
    @include('partials.tracking.meta-pixel')
    @stack('head')
</head>
<body>
@include('partials.tracking.google-analytics')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<!-- Page Loader-->
<div id="page-loader">
    <div class="page-loader-body">
        <img src="{{ asset('images/DigiSpaceLogo2.svg') }}" alt="{{ config('app.name') }}" width="170"
             height="80"/>
        <div class="cssload-wrapper">
            <div class="cssload-border">
                <div class="cssload-whitespace">
                    <div class="cssload-line"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page">
    <!-- Page Header-->
    <x-header></x-header>
    @yield('content')
    <!-- Footer Component -->
    <x-footer :$footerWidgets></x-footer>
</div>
<!-- Cookie consent banner (rendered hidden; public/js/consent.js reveals it when no decision cookie exists) -->
<x-cookie-consent/>
<!-- Global Mailform Output-->
<div class="snackbars" id="form-output-global"></div>
<!-- Javascript-->
<!-- BEGIN PLERDY CODE -->
<script type="text/javascript" defer data-plerdy_code='1'>
    (function () {
        // No consent manager means no record of a decision, so nothing may load.
        if (!window.DigiConsent) {
            return;
        }
        // No revoke handler: Plerdy has no in-page off switch, so consent.js reloads the page
        // when Analytics is withdrawn. The snippet drops its own previous tag, so re-granting
        // within one page life replaces the script rather than stacking a second one.
        DigiConsent.on('analytics', function () {
            var _protocol = "https:" == document.location.protocol ? "https://" : "http://";
            _site_hash_code = "ca16216c56a35002f0edb72556d4b626", _suid = 52604, plerdyScript = document.createElement("script");
            plerdyScript.setAttribute("defer", ""), plerdyScript.dataset.plerdymainscript = "plerdymainscript",
                plerdyScript.src = "https://a.plerdy.com/public/js/click/main.js?v=" + Math.random();
            var plerdymainscript = document.querySelector("[data-plerdymainscript='plerdymainscript']");
            plerdymainscript && plerdymainscript.parentNode.removeChild(plerdymainscript);
            try {
                document.head.appendChild(plerdyScript)
            } catch (t) {
                console.log(t, "unable add script tag")
            }
        });
    })();
</script>
<!-- END PLERDY CODE -->
@include('partials.tracking.clarity')
<!-- Start of HubSpot Embed Code -->
{{--<script type="text/javascript" id="hs-script-loader" async defer src="//js-eu1.hs-scripts.com/145191234.js"></script>--}}
<!-- End of HubSpot Embed Code -->
<script src="{{ asset('js/new-relic.js') }}"></script>
<script src="{{ asset('js/core.min.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/site.js') }}"></script>
</body>
</html>
