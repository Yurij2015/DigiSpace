<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <!-- Site Title-->
    <title>@yield('title', 'DigiSpace service')</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lato:400,700%7CSpace+Mono">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<!-- Page Loader-->
<div id="page-loader">
    <div class="page-loader-body"><img src="{{ asset('images/logo-default-95x80.png') }}" alt="" width="95"
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
                            <div class="rd-navbar-brand"><a class="brand" href="{{ route('home.index') }}">
                                    <div class="brand__name"><img class="brand__logo-dark"
                                                                  src="{{ asset('images/logo-default-95x80.png') }}"
                                                                  alt="" width="95"
                                                                  height="80"/>
                                        <img class="brand__logo-mobile"
                                             src="{{ asset('images/logo-mobile-170x50.png') }}"
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
    <!-- Page Footer-->
    <footer class="section footer-classic context-dark">
        <div class="footer-classic__main bg-gray-3">
            <div class="container">
                <div class="row row-50 align-items-sm-end justify-content-sm-center justify-content-lg-start">
                    <div class="col-lg-6">
                        <div class="footer-classic__custom-column">
                            <div class="unit flex-sm-row">
                                <div class="unit__left"><span
                                        class="icon icon-md icon-default fl-bigmug-line-headphones32"></span></div>
                                <div class="unit__body"><a class="link link-lg" href="tel:#">1-800-700-6200</a>
                                    <p>Our Support Service is always available 24 hours a day</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10 col-lg-6">
                        <div class="group-md">
                            <h3>Subscribe</h3>
                            <p class="large">Get the latest updates and offers</p>
                        </div>
                        <!-- RD Mailform-->
                        <form class="rd-mailform form_inline form_lg" data-form-output="form-output-global"
                              data-form-type="subscribe" method="post" action="bat/rd-mailform.php">
                            <div class="form-wrap">
                                <input class="form-input" id="subscribe-form-footer-form-email" type="email"
                                       name="email">
                                <label class="form-label" for="subscribe-form-footer-form-email">Your E-mail</label>
                            </div>
                            <div class="form-button">
                                <button class="button button-lg button-primary button-ujarak" type="submit">Subscribe
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row row-50 justify-content-md-center justify-content-lg-start justify-content-xl-between">
                    <div class="col-md-5 col-lg-3">
                        <p class="custom-heading-1 custom-heading-bordered">About us</p>
                        <div class="divider"></div>
                        <p class="ls-05">Our company has been developing high-quality and reliable software for
                            corporate needs since 2008.</p>
                        <ul class="list-inline list-inline-xs">
                            <li><a class="icon icon-xxs icon-circle icon-filled icon-filled_brand fa fa-facebook"
                                   href="#"></a></li>
                            <li><a class="icon icon-xxs icon-circle icon-filled icon-filled_brand fa fa-twitter"
                                   href="#"></a></li>
                            <li><a class="icon icon-xxs icon-circle icon-filled icon-filled_brand fa fa-google-plus"
                                   href="#"></a></li>
                            <li><a class="icon icon-xxs icon-circle icon-filled icon-filled_brand fa fa-instagram"
                                   href="#"></a></li>
                        </ul>
                    </div>
                    <div class="col-md-5 col-lg-4 col-xl-3">
                        <p class="custom-heading-1 custom-heading-bordered">Latest news</p>
                        <div class="divider"></div>
                        <div class="post-small-wrap">
                            <!-- Post small-->
                            <article class="post-small">
                                <div class="post-small__aside"><a class="post-small__media" href="blog-post.html"><img
                                            class="post-small__image" src="{{ asset('images/post-small-1-80x68.jpg') }}"
                                            alt=""
                                            width="80" height="68"/></a></div>
                                <div class="post-small__main">
                                    <p class="post-small__title"><a href="blog-post.html">Benefits of Async/Await in
                                            Programming</a></p>
                                    <time class="post-small__time" datetime="2022">January 12, 2022</time>
                                </div>
                            </article>
                            <!-- Post small-->
                            <article class="post-small">
                                <div class="post-small__aside"><a class="post-small__media" href="blog-post.html"><img
                                            class="post-small__image" src="{{ asset('images/post-small-2-80x68.jpg') }}"
                                            alt=""
                                            width="80" height="68"/></a></div>
                                <div class="post-small__main">
                                    <p class="post-small__title"><a href="blog-post.html">Key Considerations and
                                            Warnings of iPaaS</a></p>
                                    <time class="post-small__time" datetime="2022">January 12, 2022</time>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="col-md-10 col-lg-5 col-xl-4">
                        <p class="custom-heading-1 custom-heading-bordered">Useful Links</p>
                        <div class="divider"></div>
                        <div class="row row-5">
                            <div class="col-sm-6">
                                <ul class="list-marked list-marked_primary">
                                    <li><a href="#">DB Management</a></li>
                                    <li><a href="#">iOS/MacOs Apps</a></li>
                                    <li><a href="#">Android Apps</a></li>
                                    <li><a href="#">Windows Apps</a></li>
                                    <li><a href="#">UX Design</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul class="list-marked list-marked_primary">
                                    <li><a href="#">Tutorials</a></li>
                                    <li><a href="#">Product Support</a></li>
                                    <li><a href="contact-us.html">Contact Us</a></li>
                                    <li><a href="blog.html">Blog</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-default__aside bg-gray-5">
            <div class="container">
                <div class="footer-default__aside-inner">
                    <!-- Rights-->
                    <p class="rights"><span>&copy;&nbsp;</span><span
                            class="copyright-year"></span><span>&nbsp;</span><span>Techsoft</span><span>.&nbsp;</span><a
                            href="privacy-policy.html">Privacy Policy</a></p>
                    <ul class="list-separated list-inline">
                        <li><a href="faq.html">FAQ</a></li>
                        <li><a href="#">Support</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- Global Mailform Output-->
<div class="snackbars" id="form-output-global"></div>
<!-- Javascript-->
<script src="{{ asset('js/core.min.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
