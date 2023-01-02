@extends('layouts.main')
@section('content')
    <!-- Breadcrumbs-->
    <section class="breadcrumbs-custom">
        <div class="breadcrumbs-custom__aside bg-image context-dark"
             style="background-image: url({{ asset('images/bg-image-14-1920x330.jpg') }});">
            <div class="container">
                <h2 class="breadcrumbs-custom__title">Promos</h2>
            </div>
        </div>
        <div class="breadcrumbs-custom__main bg-gray-light">
            <div class="container">
                <ul class="breadcrumbs-custom__path">
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Promos</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Promos-->
    <section class="section section-md bg-white text-center">
        <div class="container">
            <div class="row row-30">
                <div class="col-md-6 col-lg-4">
                    <!-- Promo Classic-->
                    <article class="promo-classic">
                        <div class="promo-classic__inner">
                            <div class="promo-classic__icon-wrap">
                                <div class="promo-classic__icon"><span class="fl-bigmug-line-file69"></span></div>
                            </div>
                            <div class="promo-classic__main">
                                <div class="promo-classic__label">
                                    <svg class="promo-classic__label-svg" x="0px" y="0px" width="51px" height="23px"
                                         viewbox="0 0 51 23" preserveAspectRatio="xMaxYMin">
                                        <polygon
                                            points="0.012,0.006 0.012,22.995 43.991,22.995 43.991,23 50.988,11.5 43.991,0 43.991,0.006 "></polygon>
                                    </svg>
                                    <span>-25%</span>
                                </div>
                                <h4 class="promo-classic__title">Windows Applications</h4>
                                <div class="promo-classic__divider"></div>
                                <div class="promo-classic__price"><span
                                        class="promo-classic__price-currency">$</span><span
                                        class="promo-classic__price-value">126</span>
                                    <div class="promo-classic__price-aside"><span class="top">99</span><span
                                            class="bottom">year</span></div>
                                </div>
                                <p class="promo-classic__price-old">Old Price $200.00</p>
                                <div class="promo-classic__control"><a class="button button-primary button-ujarak"
                                                                       href="#">Order now</a></div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-lg-4">
                    <!-- Promo Classic-->
                    <article class="promo-classic">
                        <div class="promo-classic__inner">
                            <div class="promo-classic__icon-wrap">
                                <div class="promo-classic__icon"><span class="fl-bigmug-line-hot67"></span></div>
                            </div>
                            <div class="promo-classic__main">
                                <div class="promo-classic__label promo-classic__label-sm">
                                    <svg class="promo-classic__label-svg" x="0px" y="0px" width="51px" height="23px"
                                         viewbox="0 0 51 23" preserveAspectRatio="xMaxYMin">
                                        <polygon
                                            points="0.012,0.006 0.012,22.995 43.991,22.995 43.991,23 50.988,11.5 43.991,0 43.991,0.006 "></polygon>
                                    </svg>
                                    <span>Free Trial</span>
                                </div>
                                <h4 class="promo-classic__title">iOS & Android Apps</h4>
                                <div class="promo-classic__divider"></div>
                                <div class="promo-classic__price"><span
                                        class="promo-classic__price-currency">$</span><span
                                        class="promo-classic__price-value">0</span>
                                    <div class="promo-classic__price-aside"><span class="top">99</span><span
                                            class="bottom">mon</span></div>
                                </div>
                                <p class="promo-classic__price-old">Old Price $100.00</p>
                                <div class="promo-classic__control"><a class="button button-primary button-ujarak"
                                                                       href="#">Order now</a></div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-lg-4">
                    <!-- Promo Classic-->
                    <article class="promo-classic">
                        <div class="promo-classic__inner">
                            <div class="promo-classic__icon-wrap">
                                <div class="promo-classic__icon promo-classic__icon-sm"><span
                                        class="fl-bigmug-line-email64"></span></div>
                            </div>
                            <div class="promo-classic__main">
                                <div class="promo-classic__label">
                                    <svg class="promo-classic__label-svg" x="0px" y="0px" width="51px" height="23px"
                                         viewbox="0 0 51 23" preserveAspectRatio="xMaxYMin">
                                        <polygon
                                            points="0.012,0.006 0.012,22.995 43.991,22.995 43.991,23 50.988,11.5 43.991,0 43.991,0.006 "></polygon>
                                    </svg>
                                    <span>-50%</span>
                                </div>
                                <h4 class="promo-classic__title">QA & Testing Services</h4>
                                <div class="promo-classic__divider"></div>
                                <div class="promo-classic__price"><span
                                        class="promo-classic__price-currency">$</span><span
                                        class="promo-classic__price-value">45</span>
                                    <div class="promo-classic__price-aside"><span class="top">99</span><span
                                            class="bottom">mon</span></div>
                                </div>
                                <p class="promo-classic__price-old">Old Price $150.00</p>
                                <div class="promo-classic__control"><a class="button button-primary button-ujarak"
                                                                       href="#">Order now</a></div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection

