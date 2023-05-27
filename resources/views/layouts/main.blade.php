<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <!-- Site Title-->
    <title>@yield('title', 'DigiSpace service')</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <!--  Facebook -->
    @if(url()->current() === route('blog.post', $post->slug))
        <meta property="og:url" content="{{ route('blog.post', $post->slug) }}"/>
        <meta property="og:type" content="article"/>
        <meta property="og:title" content="{{ $post->name }}"/>
        <meta property="og:description" content="Add post description!!!"/>
        <meta property="og:image" content="{{ $post->img_path }}"/>
    @endif
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lato:400,700%7CSpace+Mono">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<!-- New Relic -->
<script type="text/javascript">
    ;window.NREUM||(NREUM={});NREUM.init={distributed_tracing:{enabled:true},privacy:{cookies_enabled:true},ajax:{deny_list:["bam.eu01.nr-data.net"]}};

    ;NREUM.loader_config={accountID:"3946944",trustKey:"3946944",agentID:"538475567",licenseKey:"NRJS-26995cb680e01431d2b",applicationID:"538475567"}
    ;NREUM.info={beacon:"bam.eu01.nr-data.net",errorBeacon:"bam.eu01.nr-data.net",licenseKey:"NRJS-26995cb680e01431d2b",applicationID:"538475567",sa:1}
    ;(()=>{var e,t,r={9071:(e,t,r)=>{"use strict";r.d(t,{I:()=>n});var n=0,i=navigator.userAgent.match(/Firefox[\/\s](\d+\.\d+)/);i&&(n=+i[1])},8768:(e,t,r)=>{"use strict";r.d(t,{T:()=>n,p:()=>i});const n=/(iPad|iPhone|iPod)/g.t>
</script>
<!-- Messenger Chat plugin Code -->
<div id="fb-root"></div>
<!-- Your Chat plugin code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>
<script>
    var chatbox = document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", "105137005707119");
    chatbox.setAttribute("attribution", "biz_inbox");
</script>
<!-- Your SDK code -->
<script>
    window.fbAsyncInit = function () {
        FB.init({
            xfbml: true,
            version: 'v16.0'
        });
    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
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
<script src="{{ asset('js/core.min.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
