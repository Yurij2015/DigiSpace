<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <!-- Site Title-->
    <title>@yield('title', 'DigiSpace service')</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <!--  Facebook Open Graph-->
    @if(isset($post) && $post->slug && url()->current() === route('blog.post', $post->slug))
        <meta property="og:url" content="{{ route('blog.post', $post->slug) }}"/>
        <meta property="og:type" content="article"/>
        <meta property="og:title" content="{{ $post->name }}"/>
        <meta property="og:description" content="{{ $post->description }}"/>
        <meta property="og:image" content="{{ $post->img_path }}"/>
        <meta name="description" content="{{ $post->description }}"/>
        <meta name="keywords" content="{{ $post->name }}"/>
    @endif
    @if(isset($page) && url()->current() === route('pages.page', $page->slug))
        <meta property="og:url" content="{{ route('pages.page', $page->slug) }}"/>
        <meta property="og:type" content="article"/>
        <meta property="og:title" content="{{ $page->name }}"/>
        <meta property="og:description" content="{{ $page->description }}"/>
        <meta property="og:image" content="{{ $pageImage }}"/>
        <meta name="description" content="{{ $page->description }}"/>
        <meta name="keywords" content="{{ $page->meta }}"/>
    @endif
    @if(isset($serviceCategory) && $serviceCategory->slug && url()->current() === route('category-services', $serviceCategory->slug))
        <meta property="og:url" content="{{ route('category-services', $serviceCategory->slug) }}"/>
        <meta property="og:type" content="article"/>
        <meta property="og:title" content="{{ $serviceCategory->seo_title }}"/>
        <meta property="og:description" content="{{ $serviceCategory->seo_description }}"/>
{{--        <meta property="og:image" content="{{ $serviceCategory->img_path }}"/>--}}
        <meta name="keywords" content="{{ $serviceCategory->seo_keywords }}"/>
    @endif
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lato:400,700%7CSpace+Mono">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
<!-- Page Loader-->
<div id="page-loader">
    <div class="page-loader-body">
        <img src="{{ asset('images/DigiSpaceLogo2.svg') }}" alt="" width="170"
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
</body>
</html>
