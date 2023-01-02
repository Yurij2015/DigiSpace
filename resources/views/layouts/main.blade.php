<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <!-- Site Title-->
    <title>Home</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lato:400,700%7CSpace+Mono">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<!-- Page Loader-->
<div id="page-loader">
    <div class="page-loader-body"><img src="images/logo-default-95x80.png" alt="" width="95" height="80"/>
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
    <header class="section page-header">
        <!-- RD Navbar-->
        <div class="rd-navbar-wrap">
            <nav class="rd-navbar rd-navbar-classic" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed"
                 data-sm-device-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed"
                 data-md-device-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-fixed"
                 data-lg-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static"
                 data-xl-layout="rd-navbar-static" data-stick-up-clone="false" data-md-stick-up-offset="74px"
                 data-lg-stick-up-offset="66px" data-md-stick-up="true" data-lg-stick-up="true">
                <div class="rd-navbar-outer">
                    <div class="rd-navbar-inner">
                        <!-- RD Navbar Panel-->
                        <div class="rd-navbar-panel">
                            <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span>
                            </button>
                            <!-- RD Navbar Brand-->
                            <div class="rd-navbar-brand"><a class="brand" href="index.html">
                                    <div class="brand__name"><img class="brand__logo-dark"
                                                                  src="images/logo-default-95x80.png" alt="" width="95"
                                                                  height="80"/>
                                        <img class="brand__logo-mobile"
                                             src="images/logo-mobile-170x50.png"
                                             alt="" width="170" height="50"/>
                                    </div>
                                </a></div>
                        </div>
                        <div class="rd-navbar-body">
                            <!-- RD Navbar Aside-->
                            <div class="rd-navbar-aside">
                                <div class="rd-navbar-content-outer">
                                    <div class="rd-navbar-content__toggle rd-navbar-static--hidden"
                                         data-rd-navbar-toggle=".rd-navbar-content"><span></span></div>
                                    <div class="rd-navbar-content">
                                        <ul class="list-bordered list-inline">
                                            <li>
                                                <dl class="list-terms-inline">
                                                    <dt>24/7 Support</dt>
                                                    <dd><a href="tel:#">1-800-700-6200</a></dd>
                                                </dl>
                                            </li>
                                            <li>
                                                <dl class="list-terms-inline">
                                                    <dt>E-mail</dt>
                                                    <dd><a href="mailto:#">mail@demolink.org</a></dd>
                                                </dl>
                                            </li>
                                            <li>
                                                <ul class="list-inline list-inline-xs">
                                                    <li><a class="icon icon-gray-dark icon-style-brand fa fa-facebook"
                                                           href="#"></a></li>
                                                    <li><a class="icon icon-gray-dark icon-style-brand fa fa-twitter"
                                                           href="#"></a></li>
                                                    <li>
                                                        <a class="icon icon-gray-dark icon-style-brand fa fa-google-plus"
                                                           href="#"></a></li>
                                                    <li>
                                                        <a class="icon icon-gray-dark icon-style-brand fa fa-pinterest-p"
                                                           href="#"></a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="rd-navbar-panel__button"><a
                                        class="button button-xs button-icon button-icon-left button-default button-ujarak"
                                        href="login.html"><span class="icon mdi mdi-account"></span>Login</a></div>
                            </div>
                            <!-- RD Navbar Nav Wrap-->
                            <div class="rd-navbar-nav-wrap">
                                <div class="rd-navbar-element">
                                    <!-- RD Navbar Search-->
                                    <div class="rd-navbar-search rd-navbar-search-toggled">
                                        <button class="rd-navbar-search-toggle"
                                                data-rd-navbar-toggle=".rd-navbar-search"></button>
                                        <form class="rd-search" action="search-results.html"
                                              data-search-live="rd-search-results-live" method="GET">
                                            <div class="form-wrap">
                                                <input class="form-input" id="rd-navbar-search-form-input" type="text"
                                                       name="s" autocomplete="off">
                                            </div>
                                            <button class="rd-navbar-search-submit" type="submit"></button>
                                            <label class="form-label"
                                                   for="rd-navbar-search-form-input">Search...</label>
                                            <div class="rd-search-results-live" id="rd-search-results-live"></div>
                                        </form>
                                    </div>
                                </div>
                                <!-- RD Navbar Nav-->
                                <ul class="rd-navbar-nav">
                                    <li class="{{ Route::is('about') ? 'active' : '' }}"><a
                                            href="{{ route('about') }}">About</a>
                                    </li>
                                    <li class="{{ Route::is('services') ? 'active' : '' }}"><a
                                            href="{{ route('services') }}">Services</a>
                                    </li>
                                    <li class="{{ Route::is('pricing') ? 'active' : '' }}"><a
                                            href="{{ route('pricing') }}">Pricing</a>
                                    </li>
                                    <li class="{{ Route::is('promos') ? 'active' : '' }}"><a
                                            href="{{ route('promos') }}">Promos</a>
                                    </li>
                                    <li class="{{ Route::is('blog') ? 'active' : '' }}"><a
                                            href="{{ route('blog') }}">Blog</a>
                                        <ul class="rd-navbar-dropdown">
                                            <li><a href="blog-post.html">Blog post</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Pages</a>
                                        <!-- RD Navbar Megamenu-->
                                        <ul class="rd-navbar-megamenu">
                                            <li>
                                                <h5 class="rd-megamenu-header">Pages 1</h5>
                                                <ul class="rd-megamenu-list">
                                                    <li><a href="faq.html">FAQ</a></li>
                                                    <li><a href="login.html">Login</a></li>
                                                    <li><a href="cart-page.html">Cart page</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <h5 class="rd-megamenu-header">Pages 2</h5>
                                                <ul class="rd-megamenu-list">
                                                    <li><a href="404-page.html">404 page</a></li>
                                                    <li><a href="503-page.html">503 page</a></li>
                                                    <li><a href="coming-soon.html">Coming soon</a></li>
                                                    <li><a href="maintenance.html">Maintenance</a></li>
                                                    <li><a href="privacy-policy.html">Privacy policy</a></li>
                                                    <li><a href="search-results.html">Search results</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <h5 class="rd-megamenu-header">Elements</h5>
                                                <ul class="rd-megamenu-list">
                                                    <li><a href="buttons.html">Buttons</a></li>
                                                    <li><a href="forms.html">Forms</a></li>
                                                    <li><a href="grid-system.html">Grid system</a></li>
                                                    <li><a href="progress-bars.html">Progress bars</a></li>
                                                    <li><a href="tables.html">Tables</a></li>
                                                    <li><a href="tabs-and-accordions.html">Tabs and Accordions</a></li>
                                                    <li><a href="typography.html">Typography</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="{{ Route::is('contact-us') ? 'active' : '' }}"><a
                                            href="{{ route('contact-us') }}">Contact Us</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    @yield('content')

</div>
<!-- Global Mailform Output-->
<div class="snackbars" id="form-output-global"></div>
<!-- Javascript-->
<script src="{{ asset('js/core.min.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
