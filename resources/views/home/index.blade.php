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
                                   data-caption-delay="200">We specialize in developing and supporting web applications
                                    tailored<br> to specific industry domains and corporate missions, with <br>varying
                                    levels of complexity and thematic focus.
                                    <span class="group-item"></span>
                                </p>
                                <a class="button button-lg button-primary"
                                   href="#"
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
                                <h2 data-caption-animate="fadeInUpSmall">Analysis and technology selection</h2>
                                <p class="quote-classic__text call-subtitle_text" data-caption-animate="fadeInUpSmall"
                                   data-caption-delay="200">Exceptional proficiency and expertise in business
                                    process<br>analysis, prototype creation, model development,<br> and database
                                    advancement.
                                    <span class="group-item"></span>
                                </p>
                                <a class="button button-lg button-primary"
                                   href="#"
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
             data-parallax-img="{{ asset('images/bg-2-1920x545.jpg') }}">
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
