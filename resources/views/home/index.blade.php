@extends('layouts.main')
@section('title', 'DigiSpace | Welcom to DigiSpace')
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
                                <h1 data-caption-animate="fadeInUpSmall">Welcome to DigiSpace</h1>
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
            <x-price-of-services :$products></x-price-of-services>
        </div>
    </section>
    <!-- Why Choose Us-->
    <section class="section section-sm bg-white text-center">
        <div class="container">
            <x-choose-us-component :$chooseUsCategory :$chooseUsWidgets/>
        </div>
    </section>
    <!-- Facts-->
    <section class="section parallax-container bg-gray-darker"
             data-parallax-img="{{ asset('images/bg-2-1920x545.jpg') }}">
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
            <h2>Our Projects</h2>
            <!-- Owl Carousel-->
            <div class="owl-outer-navigation-wrap owl-carousel_nav-modern wow fadeIn">
                <div class="owl-carousel quote-creative-carousel review-carousel" data-items="1" data-lg-items="2"
                     data-stage-padding="0" data-margin="30"
                     data-owl="{&quot;dots&quot;:true,&quot;nav&quot;:true,&quot;loop&quot;:true,&quot;autoplayTimeout&quot;:3500,&quot;navContainer&quot;:&quot;#owl-carousel-nav&quot;,&quot;dotsEach&quot;:1}">
                    <div class="item">
                        <!-- Quote Creative-->
                        <article class="quote-creative">
                            <div class="quote-creative__header">
                                <div class="quote-creative__media"><img src="{{ asset('images/user-2-112x99.jpg') }}"
                                                                        alt=""
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
                                <div class="quote-creative__media"><img src="{{ asset('images/user-1-112x99.jpg') }}"
                                                                        alt=""
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
                            src="{{ asset('images/brand-2-126x100.png') }}" alt="" width="126" height="100"/></a></div>
                <div class="col-sm-6 col-md-3 wow fadeIn"><a class="link-image" href="#"><img
                            src="{{ asset('images/brand-3-134x83.png') }}" alt="" width="134" height="83"/></a></div>
                <div class="col-sm-6 col-md-3 wow fadeIn"><a class="link-image" href="#"><img
                            src="{{ asset('images/brand-4-138x55.png') }}" alt="" width="138" height="55"/></a></div>
            </div>
        </div>
    </section>
@endsection
