@extends('layouts.main')
@section('title', 'DigiSpace | Welcom to DigiSpace')
@section('content')
    <!-- Swiper-->
    <section class="section swiper-container swiper-slider swiper_style-1 swiper_height-1 swiper-controls-classic"
             data-swiper='{"loop":true,"autoplay":{"delay":5000},"simulateTouch":false}'>
        <div class="swiper-wrapper">
            <div class="swiper-slide bg-image-dark"
                 data-slide-bg="{{ asset('images/slider-first-home-page.jpg') }}">
                <div class="swiper-slide-caption">
                    <div class="container text-start">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-sm-12"
                                 style="background-color: rgba(128,171,229,0.78); padding: 50px">
                                <h1 data-caption-animate="fadeInUpSmall">Opening the Space of High Technologies -
                                    DigiSpace</h1>
                                <p class="quote-classic__text call-subtitle_text"
                                   data-caption-animate="fadeInUpSmall"
                                   data-caption-delay="200">Our web development agency is your reliable partner for
                                    business automation and web development for specific industries. We offer our
                                    expertise combined with top-notch technologies!
                                    <span class="group-item"></span>
                                </p>
                                <a class="button button-lg button-primary"
                                   href="{{ route('pages.page', 'opening-the-space-of-high-technologies') }}"
                                   data-caption-animate="fadeInUpSmall"
                                   data-caption-delay="250">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide bg-image-dark" data-slide-bg="images/slider-second-home-page.jpg">
                <div class="swiper-slide-caption">
                    <div class="container text-start">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-sm-12"
                                 style="background-color: rgba(128,171,229,0.78); padding: 50px">
                                <h2 data-caption-animate="fadeInUpSmall">Top-Notch Analytics and Consulting on Web
                                    Development Technologies</h2>
                                <p class="quote-classic__text call-subtitle_text" data-caption-animate="fadeInUpSmall"
                                   data-caption-delay="200">Our expertise is at your service. We provide consulting
                                    services and an overall evaluation of your ideas to select the best technologies and
                                    solutions for your benefit.
                                    <span class="group-item"></span>
                                </p>
                                <a class="button button-lg button-primary"
                                   href="{{ route('pages.page', 'top-notch-analytics-and-consulting-on-web-development-technologies') }}"
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
    <div id="app">
        <navbar></navbar>
    </div>
    <!-- Our service-->
    <section class="section section-lg bg-white text-center">
        <div class="container">
            <x-our-services-component/>
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
             data-parallax-img="{{ asset('images/bg-about-page-some-facts.jpeg') }}">
        <div class="parallax-content">
            <div class="section-lg text-center text-sm-start">
                <div class="container">
                    <x-some-facts-about-us-main/>
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
            <x-our-projects :$clientsCategory :$clients></x-our-projects>
        </div>
    </section>
    <!-- Technologies -->
    <x-technologies></x-technologies>
@endsection
