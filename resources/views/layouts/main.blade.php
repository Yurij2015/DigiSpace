<!DOCTYPE html>
<html class="wide wow-animation" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Site Title-->
    <title>@yield('title', __('site.default_title'))</title>
    @php
        $localizedRouteNames = config('locales.route_names', []);
        $currentRouteName = Route::currentRouteName();
        $currentRouteParameters = request()->route()?->parameters() ?? [];
        unset($currentRouteParameters['locale']);

        $seoPost = $currentRouteName === 'blog.post' && ($post ?? null) instanceof \App\Models\Post ? $post : null;
        $seoPage = in_array($currentRouteName, ['pages.page', 'privacy-policy', 'faq', 'support'], true)
            && ($page ?? null) instanceof \App\Models\Page ? $page : null;
        $seoService = $currentRouteName === 'category-service' && ($service ?? null) instanceof \App\Models\Service ? $service : null;
        $seoCategory = in_array($currentRouteName, ['category-service', 'category-services'], true)
            && ($serviceCategory ?? null) instanceof \App\Models\ServiceCategory ? $serviceCategory : null;

        $metaDescription = match (true) {
            $seoPost !== null => $seoPost->description,
            $seoPage !== null => $seoPage->description,
            $seoService !== null => $seoService->seo_description,
            $seoCategory !== null => $seoCategory->seo_description,
            default => null,
        } ?: __('site.meta_description');
        $ogTitle = match (true) {
            $seoPost !== null => $seoPost->name,
            $seoPage !== null => $seoPage->name,
            $seoService !== null => $seoService->seo_title ?: $seoService->title,
            $seoCategory !== null => $seoCategory->seo_title ?: $seoCategory->name,
            default => null,
        } ?: $__env->yieldContent('title', __('site.default_title'));
        $pageImageUrl = null;
        if ($seoPage !== null && filled($pageImage ?? null)) {
            $pageImageUrl = match (true) {
                Str::startsWith($pageImage, ['http://', 'https://']) => $pageImage,
                Str::startsWith($pageImage, '//') => request()->getScheme().':'.$pageImage,
                Str::startsWith($pageImage, ['/', 'uploads/']) => asset($pageImage),
                default => asset('uploads/widgets/'.$pageImage),
            };
        }
        $ogImage = match (true) {
            $seoPost !== null => $seoPost->img_path ? asset($seoPost->img_path) : null,
            $seoPage !== null => $pageImageUrl,
            $seoService !== null => asset($seoService->image),
            default => null,
        } ?: asset('images/bg-3-1920x480.jpg');
        $jsonLd = \App\Support\SchemaMarkup::graph([
            'route' => $currentRouteName,
            'url' => url()->current(),
            'title' => $ogTitle,
            'description' => $metaDescription,
            'image' => $ogImage,
            'locale' => app()->getLocale(),
            'post' => $seoPost,
            'page' => $seoPage,
            'service' => $seoService,
            'serviceCategory' => $seoCategory,
            'socials' => isset($headerNavBarContent) ? [
                $headerNavBarContent->first_soc_button_href,
                $headerNavBarContent->second_soc_button_href,
                $headerNavBarContent->third_soc_button_href,
                $headerNavBarContent->fourth_soc_button_href,
            ] : [],
        ]);
    @endphp
    <meta name="description" content="{{ Str::limit($metaDescription, 157) }}">
    @if($__env->yieldContent('robots') === 'noindex' || request()->routeIs('blog-search', 'service-search', 'error-404'))
        <meta name="robots" content="noindex">
    @endif
    @if(in_array($currentRouteName, $localizedRouteNames, true))
        <link rel="canonical" href="{{ route($currentRouteName, array_merge(['locale' => app()->getLocale()], $currentRouteParameters), true) }}">
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
    <meta property="og:site_name" content="{{ config('app.name') }}"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:title" content="{{ $ogTitle }}"/>
    <meta name="twitter:description" content="{{ Str::limit($metaDescription, 200) }}"/>
    <meta name="twitter:image" content="{{ $ogImage }}"/>
    <script type="application/ld+json">{!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}</script>
    @if($seoPost !== null)
        <meta name="keywords" content="{{ $seoPost->name }}"/>
    @elseif($seoPage !== null)
        <meta name="keywords" content="{{ $seoPage->meta }}"/>
    @elseif($seoService !== null)
        <meta name="keywords" content="{{ $seoService->seo_keywords }}"/>
    @elseif($seoCategory !== null)
        <meta name="keywords" content="{{ $seoCategory->seo_keywords }}"/>
    @endif
    <link rel="alternate icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicons/site.svg') }}" type="image/svg+xml">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lato:400,700%7CSpace+Mono">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">

    <!-- Meta Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', {{ config('app.facebook_pixel_id') }});
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=3391481047783233&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Meta Pixel Code -->
    @stack('head')
</head>
<body>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-5SMHNENJQK"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-5SMHNENJQK');
</script>
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
<!-- Global Mailform Output-->
<div class="snackbars" id="form-output-global"></div>
<!-- Javascript-->
<!-- BEGIN PLERDY CODE -->
<script type="text/javascript" defer data-plerdy_code='1'>
    var _protocol="https:"==document.location.protocol?"https://":"http://";
    _site_hash_code = "ca16216c56a35002f0edb72556d4b626",_suid=52604, plerdyScript=document.createElement("script");
    plerdyScript.setAttribute("defer",""),plerdyScript.dataset.plerdymainscript="plerdymainscript",
        plerdyScript.src="https://a.plerdy.com/public/js/click/main.js?v="+Math.random();
    var plerdymainscript=document.querySelector("[data-plerdymainscript='plerdymainscript']");
    plerdymainscript&&plerdymainscript.parentNode.removeChild(plerdymainscript);
    try{document.head.appendChild(plerdyScript)}catch(t){console.log(t,"unable add script tag")}
</script>
<!-- END PLERDY CODE -->
<!-- Start of HubSpot Embed Code -->
{{--<script type="text/javascript" id="hs-script-loader" async defer src="//js-eu1.hs-scripts.com/145191234.js"></script>--}}
<!-- End of HubSpot Embed Code -->
<script src="{{ asset('js/new-relic.js') }}"></script>
<script src="{{ asset('js/core.min.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/site.js') }}"></script>
</body>
</html>
