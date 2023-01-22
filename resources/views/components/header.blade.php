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
                        <div class="rd-navbar-brand">
                            <a class="brand" href="{{ route('home.index') }}">
                                <div class="brand__name">
                                    <img class="brand__logo-dark"
                                         src="{{ asset('images/logo-default-95x80.png') }}"
                                         alt="" width="95"
                                         height="80"/>
                                    <img class="brand__logo-mobile"
                                         src="{{ asset('images/logo-mobile-170x50.png') }}"
                                         alt="" width="170" height="50"/>
                                </div>
                            </a>
                        </div>
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
                                        @foreach($postsForMenu as $post)
                                            <li><a href="{{ route('blog.post', $post->slug) }}">Blog post - {{ $post->id }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="#">Pages</a>
                                    <!-- RD Navbar Megamenu-->
                                    <ul class="rd-navbar-megamenu">
                                        <li>
                                            <h5 class="rd-megamenu-header">SubMenu 1</h5>
                                            <ul class="rd-megamenu-list">
                                                @foreach($pageSubmenuFirst as $submenu)
                                                    @foreach($submenu->menuItem as $item)
                                                        <li>
                                                            <a href="{{ route('pages.page', $item->slug) }}">{{ $item->name }}</a>
                                                        </li>
                                                    @endforeach
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li>
                                            <h5 class="rd-megamenu-header">SubMenu 2</h5>
                                            <ul class="rd-megamenu-list">
                                                @foreach($pageSubmenuSecond as $submenu)
                                                    @foreach($submenu->menuItem as $item)
                                                        <li>
                                                            <a href="{{ route('pages.page', $item->slug) }}">{{ $item->name }}</a>
                                                        </li>
                                                    @endforeach
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li>
                                            <h5 class="rd-megamenu-header">SubMenu 3</h5>
                                            <ul class="rd-megamenu-list">
                                                @foreach($pageSubmenuThird as $submenu)
                                                    @foreach($submenu->menuItem as $item)
                                                        <li>
                                                            <a href="{{ route('pages.page', $item->slug) }}">{{ $item->name }}</a>
                                                        </li>
                                                    @endforeach
                                                @endforeach
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
