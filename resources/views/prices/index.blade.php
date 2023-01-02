@extends('layouts.main')
@section('title', 'DigiSpace | Prices')
@section('content')
    <!-- Swiper-->
    <section class="section swiper-container swiper-slider swiper_style-1 swiper_height-1 swiper-controls-classic"
             data-swiper='{"loop":true,"autoplay":{"delay":5000},"simulateTouch":false}'>
        <div class="swiper-wrapper">
            <div class="swiper-slide bg-image-dark" data-slide-bg="images/slider-classic-slide-1-1920x710.jpg">
                <div class="swiper-slide-caption">
                    <div class="container text-start">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-sm-12">
                                <h1 data-caption-animate="fadeInUpSmall">Welcome to TechSoft</h1>
                                <p class="quote-classic__text call-subtitle_text" data-caption-animate="fadeInUpSmall"
                                   data-caption-delay="200">Since our establishment, we have been delivering
                                    high-quality and <br>sustainable software solutions for corporate business purposes.<span
                                        class="group-item"></span></p><a class="button button-lg button-primary"
                                                                         href="hosting.html"
                                                                         data-caption-animate="fadeInUpSmall"
                                                                         data-caption-delay="250">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide bg-image-dark" data-slide-bg="images/slider-classic-slide-2-1920x710.jpg">
                <div class="swiper-slide-caption">
                    <div class="container text-start">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-sm-12">
                                <h1 data-caption-animate="fadeInUpSmall">Award-Winning Software</h1>
                                <p class="quote-classic__text call-subtitle_text" data-caption-animate="fadeInUpSmall"
                                   data-caption-delay="200">The software solutions developed by our company have
                                    been<br>numerously awarded for usability and innovative features.<span
                                        class="group-item"></span></p><a class="button button-lg button-primary"
                                                                         href="hosting.html"
                                                                         data-caption-animate="fadeInUpSmall"
                                                                         data-caption-delay="250">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </section>
    <!-- Our service-->
    <section class="section section-lg bg-white text-center">
        <div class="container">
            <h2>Our Services</h2>
            <div class="row row-30 justify-content-md-center">
                <div class="col-md-6 col-lg-4">
                    <!-- Box Chloe-->
                    <article class="box-chloe box-chloe_secondary">
                        <div class="box-chloe__icon linearicons-window"></div>
                        <div class="box-chloe__main">
                            <h4 class="box-chloe__title">Windows Applications</h4>
                            <p>We design and develop a variety of applications for Windows including specialized and
                                custom software.</p><a class="button button-sm button-default button-ujarak"
                                                       href="hosting.html">View Details</a>
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-lg-4">
                    <!-- Box Chloe-->
                    <article class="box-chloe box-chloe_secondary">
                        <div class="box-chloe__icon linearicons-database-check"></div>
                        <div class="box-chloe__main">
                            <h4 class="box-chloe__title">Database Management</h4>
                            <p>TechSoft provides top-notch database management solutions for small and medium businesses
                                worldwide.</p><a class="button button-sm button-default button-ujarak"
                                                 href="hosting.html">View Details</a>
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-lg-4">
                    <!-- Box Chloe-->
                    <article class="box-chloe box-chloe_secondary">
                        <div class="box-chloe__icon linearicons-vector"></div>
                        <div class="box-chloe__main">
                            <h4 class="box-chloe__title">UX & UI Design</h4>
                            <p>Our team of UX designers creates easy-to-understand interfaces for all kinds of
                                applications.</p><a class="button button-sm button-default button-ujarak"
                                                    href="hosting.html">View Details</a>
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-lg-4">
                    <!-- Box Chloe-->
                    <article class="box-chloe box-chloe_secondary">
                        <div class="box-chloe__icon linearicons-desktop"></div>
                        <div class="box-chloe__main">
                            <h4 class="box-chloe__title">iOS/MacOS Apps</h4>
                            <p>Our company also develops multipurpose applications for iOS and MacOS systems and
                                devices.</p><a class="button button-sm button-default button-ujarak"
                                               href="hosting.html">View Details</a>
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-lg-4">
                    <!-- Box Chloe-->
                    <article class="box-chloe box-chloe_secondary">
                        <div class="box-chloe__icon linearicons-bug"></div>
                        <div class="box-chloe__main">
                            <h4 class="box-chloe__title">QA & Testing</h4>
                            <p>We pay a lot of attention to QA and Testing procedures to ensure the best quality of our
                                software.</p><a class="button button-sm button-default button-ujarak"
                                                href="hosting.html">View Details</a>
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-lg-4">
                    <!-- Box Chloe-->
                    <article class="box-chloe box-chloe_secondary">
                        <div class="box-chloe__icon linearicons-tablet2"></div>
                        <div class="box-chloe__main">
                            <h4 class="box-chloe__title">Android Applications</h4>
                            <p>Our Android apps are highly rated by media and our users as they offer great features on
                                all Android devices.</p><a class="button button-sm button-default button-ujarak"
                                                           href="hosting.html">View Details</a>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
    <!-- Pricing Tables-->
    <section class="section section-md bg-gray-2 text-center oh">
        <div class="container wow fadeInUpSmall">
            <h2>Pricing Plans</h2>
            <div class="pricing-table pricing-table-classic">
                <!-- Pricing table item-->
                <article class="pricing-table__item pricing-table-classic__item">
                    <div class="pricing-table__item-header">
                        <p class="pricing-table__item-title">Basic</p>
                    </div>
                    <div class="pricing-table__item-price"><span
                            class="pricing-table__item-price-currency">$</span><span
                            class="pricing-table__item-price-value">399</span>
                        <div class="pricing-table__item-price-aside"><span class="top">99</span></div>
                    </div>
                    <ul class="pricing-table__item-features">
                        <li><span class="text-marked">Concept development<br>UI design</span></li>
                        <li>Configuration management</li>
                        <li>Software quality assurance</li>
                        <li>App integration</li>
                    </ul>
                    <div class="pricing-table__item-control"><a class="button button-default button-ujarak" href="#">Order
                            now</a></div>
                </article>
                <!-- Pricing table item-->
                <article class="pricing-table__item pricing-table-classic__item pricing-table-classic__item_prefered">
                    <div class="pricing-table__item-header">
                        <div class="pricing-table__item-label">Bestseller</div>
                        <p class="pricing-table__item-title">Optimal</p>
                    </div>
                    <div class="pricing-table__item-price"><span
                            class="pricing-table__item-price-currency">$</span><span
                            class="pricing-table__item-price-value">599</span>
                        <div class="pricing-table__item-price-aside"><span class="top">99</span></div>
                    </div>
                    <ul class="pricing-table__item-features">
                        <li><span class="text-marked">Concept development<br>UI design</span></li>
                        <li><span class="text-marked">Configuration management</span></li>
                        <li><span class="text-marked">Software quality assurance</span></li>
                        <li>App integration</li>
                    </ul>
                    <div class="pricing-table__item-control"><a class="button btn-primary" href="#">Order now</a></div>
                </article>
                <!-- Pricing table item-->
                <article class="pricing-table__item pricing-table-classic__item">
                    <div class="pricing-table__item-header">
                        <p class="pricing-table__item-title">Ultimate</p>
                    </div>
                    <div class="pricing-table__item-price"><span
                            class="pricing-table__item-price-currency">$</span><span
                            class="pricing-table__item-price-value">999</span>
                        <div class="pricing-table__item-price-aside"><span class="top">99</span></div>
                    </div>
                    <ul class="pricing-table__item-features">
                        <li><span class="text-marked">Concept development<br>UI design</span></li>
                        <li><span class="text-marked">Configuration management</span></li>
                        <li><span class="text-marked">Software quality assurance</span></li>
                        <li><span class="text-marked">App integration</span></li>
                    </ul>
                    <div class="pricing-table__item-control"><a class="button button-default button-ujarak" href="#">Order
                            now</a></div>
                </article>
            </div>
        </div>
    </section>
    <!-- Why Choose Us-->
    <section class="section section-sm bg-white text-center">
        <div class="container">
            <h2>Why Choose Us</h2>
            <div class="row row-30 wow fadeIn">
                <div class="col-md-6 col-lg-4">
                    <!-- Box Alice-->
                    <article class="box-alice">
                        <div class="box-alice__inner">
                            <div class="box-alice__aside">
                                <div class="box-alice__icon-outer">
                                    <div class="icon-figure">
                                        <div class="box-triangle">
                                            <svg x="0px" y="0px" width="80px" height="80px" viewBox="0 0 100 100"
                                                 style="fill: #f7f7f7;">
                                                <path
                                                    d="M20,93.301c-11,0-15.5-7.794-10-17.321l30-51.962c5.5-9.526,14.5-9.526,20,0l30,51.962 c5.5,9.526,1,17.321-10,17.321H20z"></path>
                                            </svg>
                                        </div>
                                        <span class="box-alice__icon linearicons-cog"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="box-alice__main">
                                <h5 class="box-alice__title">High Quality Hardware</h5>
                                <p>We use top-notch hardware to develop the most efficient apps for our customers.</p>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-lg-4">
                    <!-- Box Alice-->
                    <article class="box-alice">
                        <div class="box-alice__inner">
                            <div class="box-alice__aside">
                                <div class="box-alice__icon-outer">
                                    <div class="icon-figure">
                                        <div class="box-triangle">
                                            <svg x="0px" y="0px" width="80px" height="80px" viewBox="0 0 100 100"
                                                 style="fill: #f7f7f7;">
                                                <path
                                                    d="M20,93.301c-11,0-15.5-7.794-10-17.321l30-51.962c5.5-9.526,14.5-9.526,20,0l30,51.962 c5.5,9.526,1,17.321-10,17.321H20z"></path>
                                            </svg>
                                        </div>
                                        <span class="box-alice__icon linearicons-headset"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="box-alice__main">
                                <h5 class="box-alice__title">Dedicated 24\7 Support</h5>
                                <p>You can rely on our 24/7 tech support that will gladly solve any app issue you may
                                    have.</p>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-lg-4">
                    <!-- Box Alice-->
                    <article class="box-alice">
                        <div class="box-alice__inner">
                            <div class="box-alice__aside">
                                <div class="box-alice__icon-outer">
                                    <div class="icon-figure">
                                        <div class="box-triangle">
                                            <svg x="0px" y="0px" width="80px" height="80px" viewBox="0 0 100 100"
                                                 style="fill: #f7f7f7;">
                                                <path
                                                    d="M20,93.301c-11,0-15.5-7.794-10-17.321l30-51.962c5.5-9.526,14.5-9.526,20,0l30,51.962 c5.5,9.526,1,17.321-10,17.321H20z"></path>
                                            </svg>
                                        </div>
                                        <span class="box-alice__icon linearicons-wallet"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="box-alice__main">
                                <h5 class="box-alice__title">30-Day Money-back Guarantee</h5>
                                <p>If you are not satisfied with our apps, we will return your money in the first 30
                                    days.</p>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-lg-4">
                    <!-- Box Alice-->
                    <article class="box-alice">
                        <div class="box-alice__inner">
                            <div class="box-alice__aside">
                                <div class="box-alice__icon-outer">
                                    <div class="icon-figure">
                                        <div class="box-triangle">
                                            <svg x="0px" y="0px" width="80px" height="80px" viewBox="0 0 100 100"
                                                 style="fill: #f7f7f7;">
                                                <path
                                                    d="M20,93.301c-11,0-15.5-7.794-10-17.321l30-51.962c5.5-9.526,14.5-9.526,20,0l30,51.962 c5.5,9.526,1,17.321-10,17.321H20z"></path>
                                            </svg>
                                        </div>
                                        <span class="box-alice__icon linearicons-rocket"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="box-alice__main">
                                <h5 class="box-alice__title">Agile and Fast Working Style</h5>
                                <p>This type of approach to our work helps our specialists to quickly develop better
                                    apps.</p>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-lg-4">
                    <!-- Box Alice-->
                    <article class="box-alice">
                        <div class="box-alice__inner">
                            <div class="box-alice__aside">
                                <div class="box-alice__icon-outer">
                                    <div class="icon-figure">
                                        <div class="box-triangle">
                                            <svg x="0px" y="0px" width="80px" height="80px" viewBox="0 0 100 100"
                                                 style="fill: #f7f7f7;">
                                                <path
                                                    d="M20,93.301c-11,0-15.5-7.794-10-17.321l30-51.962c5.5-9.526,14.5-9.526,20,0l30,51.962 c5.5,9.526,1,17.321-10,17.321H20z"></path>
                                            </svg>
                                        </div>
                                        <span class="box-alice__icon linearicons-phone"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="box-alice__main">
                                <h5 class="box-alice__title">Some Apps are Free</h5>
                                <p>We also develop free apps that can be downloaded online without any payments.</p>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-lg-4">
                    <!-- Box Alice-->
                    <article class="box-alice">
                        <div class="box-alice__inner">
                            <div class="box-alice__aside">
                                <div class="box-alice__icon-outer">
                                    <div class="icon-figure">
                                        <div class="box-triangle">
                                            <svg x="0px" y="0px" width="80px" height="80px" viewBox="0 0 100 100"
                                                 style="fill: #f7f7f7;">
                                                <path
                                                    d="M20,93.301c-11,0-15.5-7.794-10-17.321l30-51.962c5.5-9.526,14.5-9.526,20,0l30,51.962 c5.5,9.526,1,17.321-10,17.321H20z"></path>
                                            </svg>
                                        </div>
                                        <span class="box-alice__icon linearicons-thumbs-up"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="box-alice__main">
                                <h5 class="box-alice__title">High Level of Usability</h5>
                                <p>All our products have high usability allowing users to easily operate the apps.</p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
    <!-- Facts-->
    <section class="section parallax-container bg-gray-darker" data-parallax-img="images/bg-2-1920x545.jpg">
        <div class="parallax-content">
            <div class="section-lg text-center text-sm-start">
                <div class="container">
                    <div
                        class="row row-50 flex-md-row-reverse justify-content-md-between align-items-center align-items-lg-start">
                        <div class="col-md-5 wow fadeInRightSmall">
                            <div class="box-width-3 box-centered">
                                <h2>Some Facts About Us</h2>
                                <p class="text-style-1">More than 1000 applications developed</p><a
                                    class="button button-lg btn-primary button-ujarak" href="about.html">Read More</a>
                            </div>
                        </div>
                        <div class="col-md-7 col-lg-6 wow fadeInLeftSmall">
                            <div class="row row-style-1">
                                <div class="col-sm-6">
                                    <div class="col-inner">
                                        <!-- Box counter-->
                                        <!--Counter-->
                                        <article class="box-counter box-counter_modern">
                                            <div class="box-counter__main">
                                                <div class="box-counter__icon linearicons-outbox"></div>
                                                <div class="counter-prefix">1.</div>
                                                <div class="counter">6</div>
                                                <div class="small">k</div>
                                            </div>
                                            <p class="box-counter__title">Apps Installed</p>
                                        </article>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="col-inner">
                                        <!-- Box counter-->
                                        <!--Counter-->
                                        <article class="box-counter box-counter_modern">
                                            <div class="box-counter__main">
                                                <div class="box-counter__icon linearicons-diamond2"></div>
                                                <div class="counter">27</div>
                                            </div>
                                            <p class="box-counter__title">Awards Won</p>
                                        </article>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="col-inner">
                                        <!--Counter-->
                                        <article class="box-counter box-counter_modern">
                                            <div class="box-counter__main">
                                                <div class="box-counter__icon linearicons-user"></div>
                                                <div class="counter">45</div>
                                                <div class="counter-postfix">+</div>
                                            </div>
                                            <p class="box-counter__title">Staff Members</p>
                                        </article>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="col-inner">
                                        <!--Counter-->
                                        <article class="box-counter box-counter_modern">
                                            <div class="box-counter__main">
                                                <div class="box-counter__icon linearicons-heart"></div>
                                                <div class="counter">99</div>
                                                <div class="small small_top">%</div>
                                            </div>
                                            <p class="box-counter__title">Satisfied Customers</p>
                                        </article>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Our Clients-->
    <section class="section section-md bg-gray-light text-center">
        <svg x="0px" y="0px" width="0" height="0">
            <defs>
                <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" stop-color="#00abfa"></stop>
                    <stop offset="100%" stop-color="#00caad"></stop>
                </linearGradient>
            </defs>
        </svg>
        <div class="container">
            <h2>Our Clients</h2>
            <!-- Owl Carousel-->
            <div class="owl-outer-navigation-wrap owl-carousel_nav-modern wow fadeIn">
                <div class="owl-carousel quote-creative-carousel review-carousel" data-items="1" data-lg-items="2"
                     data-stage-padding="0" data-margin="30"
                     data-owl="{&quot;dots&quot;:true,&quot;nav&quot;:true,&quot;loop&quot;:true,&quot;autoplayTimeout&quot;:3500,&quot;navContainer&quot;:&quot;#owl-carousel-nav&quot;,&quot;dotsEach&quot;:1}">
                    <div class="item">
                        <!-- Quote Creative-->
                        <article class="quote-creative">
                            <div class="quote-creative__header">
                                <div class="quote-creative__media"><img src="images/user-2-112x99.jpg" alt=""
                                                                        width="112" height="99"/>
                                </div>
                                <div class="quote-creative__info">
                                    <p class="quote-creative__title">Michael Johnson</p>
                                    <p class="quote-creative__subtitle">Regular Client</p>
                                </div>
                            </div>
                            <div class="quote-creative__main">
                                <div class="quote-creative__mark">
                                    <svg x="0px" y="0px" width="39px" height="21px" viewbox="0 0 39 21">
                                        <g fill="url(#grad1)">
                                            <polyline
                                                points="8.955,21 0,14.031 0.002,0.001 15.984,0.001 15.984,13.984 8.969,14.016 "></polyline>
                                            <polyline
                                                points="31.97,20.999 23.016,14.031 23.018,0.001 39,0.001 39,13.984 31.984,14.015 "></polyline>
                                        </g>
                                    </svg>
                                </div>
                                <div class="quote-creative__main-text">
                                    <p>TechSoft offers a high caliber of resources skilled in Microsoft Azure .NET,
                                        mobile and Quality Assurance. They became our true business partners over the
                                        past three years of our cooperation.</p>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="item">
                        <!-- Quote Creative-->
                        <article class="quote-creative">
                            <div class="quote-creative__header">
                                <div class="quote-creative__media"><img src="images/user-1-112x99.jpg" alt=""
                                                                        width="112" height="99"/>
                                </div>
                                <div class="quote-creative__info">
                                    <p class="quote-creative__title">Rachel Adams</p>
                                    <p class="quote-creative__subtitle">Regular Client</p>
                                </div>
                            </div>
                            <div class="quote-creative__main">
                                <div class="quote-creative__mark">
                                    <svg x="0px" y="0px" width="39px" height="21px" viewbox="0 0 39 21">
                                        <g fill="url(#grad1)">
                                            <polyline
                                                points="8.955,21 0,14.031 0.002,0.001 15.984,0.001 15.984,13.984 8.969,14.016 "></polyline>
                                            <polyline
                                                points="31.97,20.999 23.016,14.031 23.018,0.001 39,0.001 39,13.984 31.984,14.015 "></polyline>
                                        </g>
                                    </svg>
                                </div>
                                <div class="quote-creative__main-text">
                                    <p>TechSoft is a highly skilled and uniquely capable firm with multitudes of talent
                                        on-board. We have collaborated on a number of diverse projects that have been a
                                        great success.</p>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="owl-outer-navigation" id="owl-carousel-nav"></div>
            </div>
        </div>
    </section>
    <!-- Partners-->
    <section class="section section-md bg-white text-center">
        <div class="container">
            <div class="row row-30 align-items-sm-center">
                <div class="col-sm-6 col-md-3 wow fadeIn"><a class="link-image" href="#"><img
                            src="{{ asset('images/brand-1-126x68.png') }}" alt="" width="126" height="68"/></a></div>
                <div class="col-sm-6 col-md-3 wow fadeIn"><a class="link-image" href="#"><img
                            src=" {{ asset('images/brand-2-126x100.png') }}" alt="" width="126" height="100"/></a></div>
                <div class="col-sm-6 col-md-3 wow fadeIn"><a class="link-image" href="#"><img
                            src="{{ asset('images/brand-3-134x83.png') }}" alt="" width="134" height="83"/></a></div>
                <div class="col-sm-6 col-md-3 wow fadeIn"><a class="link-image" href="#"><img
                            src="{{ asset('images/brand-4-138x55.png') }}" alt="" width="138" height="55"/></a></div>
            </div>
        </div>
    </section>
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
@endsection
