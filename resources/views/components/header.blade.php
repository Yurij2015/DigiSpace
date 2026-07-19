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
                                         src="{{ asset('images/DigiSpaceLogo2.svg') }}"
                                         alt="" width="170"
                                         height="80"/>
                                    <img class="brand__logo-mobile"
                                         src="{{ asset('images/DigiSpaceLogo2.svg') }}"
                                         alt="" width="170" height="50"/>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="rd-navbar-body">
                        <!-- RD Navbar Top -->
                        <div class="rd-navbar-aside">
                            <x-header-navbar-content/>
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
                                <li class="{{ Route::is('about') ? 'active' : '' }}">
                                    <a href="{{ route('about') }}">About</a>
                                </li>
                                <li class="{{ Route::is('services') ? 'active' : '' }}">
                                    <a href="{{ route('services') }}">Services</a>
                                    @if(isset($serviceCategories) && count($serviceCategories))
                                        ;
                                        <ul class="rd-navbar-dropdown">
                                            @foreach($serviceCategories as $serviceCategory)
                                                <li>
                                                    <a href="{{ route('category-services', $serviceCategory->slug) }}">
                                                        {{ $serviceCategory->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                                <li class="{{ Route::is('pricing') ? 'active' : '' }}">
                                    <a href="{{ route('pricing') }}">Pricing</a>
                                </li>
                                @php
                                    $isPromoTabActive = config('settings.is_promo_tab_active');
                                @endphp
                                @if($isPromoTabActive)
                                    <li class="{{ Route::is('promos') ? 'active' : '' }}">
                                        <a href="{{ route('promos') }}">Promos</a>
                                    </li>
                                @endif
                                <li class="{{ Route::is('blog') ? 'active' : '' }}">
                                    <a href="{{ route('blog') }}">Blog</a>
                                    <ul class="rd-navbar-dropdown">
                                        @foreach($postsForMenu as $post)
                                            <li>
                                                <a href="{{ route('blog.post', $post->slug) }}">
                                                    {{ $post->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="#">Pages</a>
                                    <!-- RD Navbar Megamenu-->
                                    <ul class="rd-navbar-megamenu">
                                        <li>
                                            @foreach($pageSubmenuFirst as $submenu)
                                                <h5 class="rd-megamenu-header">{{ $submenu->title }}</h5>
                                                <ul class="rd-megamenu-list">
                                                    @foreach($submenu->menuItem as $item)
                                                        <li>
                                                            <a href="{{ route('pages.page', $item->slug) }}">
                                                                {{ $item->name }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endforeach
                                        </li>
                                        <li>
                                            @foreach($pageSubmenuSecond as $submenu)
                                                <h5 class="rd-megamenu-header">{{ $submenu->title }}</h5>
                                                <ul class="rd-megamenu-list">
                                                    @foreach($submenu->menuItem as $item)
                                                        <li>
                                                            <a href="{{ route('pages.page', $item->slug) }}">
                                                                {{ $item->name }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endforeach
                                        </li>
                                        <li>
                                            @foreach($pageSubmenuThird as $submenu)
                                                <h5 class="rd-megamenu-header">{{ $submenu->title }}</h5>
                                                <ul class="rd-megamenu-list">
                                                    @foreach($submenu->menuItem as $item)
                                                        <li>
                                                            <a href="{{ route('pages.page', $item->slug) }}">
                                                                {{ $item->name }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endforeach
                                        </li>
                                    </ul>
                                </li>
                                <li class="{{ Route::is('contact-us') ? 'active' : '' }}">
                                    <a href="{{ route('contact-us') }}">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
