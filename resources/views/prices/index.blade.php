@extends('layouts.main')
@section('title', 'DigiSpace | Prices')
@section('content')
    <!-- Breadcrumbs-->
    <section class="breadcrumbs-custom">
        <div class="breadcrumbs-custom__aside bg-image context-dark" style="background-image: url({{ asset("images/bg-image-5-1920x1200.jpg") }});">
            <div class="container">
                <h2 class="breadcrumbs-custom__title">Pricing</h2>
            </div>
        </div>
        <div class="breadcrumbs-custom__main bg-gray-light">
            <div class="container">
                <ul class="breadcrumbs-custom__path">
                    <li><a href="{{ route('home.index') }}">Home</a></li>
                    <li class="active">Pricing</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Pricing Tables-->
    <section class="section section-md bg-gray-light text-center">
        <div class="container">
            <h2>#1</h2>
            <div class="pricing-table pricing-table-classic">
                <!-- Pricing table item-->
                <article class="pricing-table__item pricing-table-classic__item">
                    <div class="pricing-table__item-header">
                        <p class="pricing-table__item-title">Basic</p>
                    </div>
                    <div class="pricing-table__item-price"><span class="pricing-table__item-price-currency">$</span><span class="pricing-table__item-price-value">399</span>
                        <div class="pricing-table__item-price-aside"><span class="top">99</span></div>
                    </div>
                    <ul class="pricing-table__item-features">
                        <li><span class="text-marked">Concept development<br>UI design</span></li>
                        <li>Configuration management</li>
                        <li>Software quality assurance</li>
                        <li>App integration</li>
                    </ul>
                    <div class="pricing-table__item-control"><a class="button button-default button-ujarak" href="#">Order now</a></div>
                </article>
                <!-- Pricing table item-->
                <article class="pricing-table__item pricing-table-classic__item pricing-table-classic__item_prefered">
                    <div class="pricing-table__item-header">
                        <div class="pricing-table__item-label">Bestseller</div>
                        <p class="pricing-table__item-title">Optimal</p>
                    </div>
                    <div class="pricing-table__item-price"><span class="pricing-table__item-price-currency">$</span><span class="pricing-table__item-price-value">599</span>
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
                    <div class="pricing-table__item-price"><span class="pricing-table__item-price-currency">$</span><span class="pricing-table__item-price-value">999</span>
                        <div class="pricing-table__item-price-aside"><span class="top">99</span></div>
                    </div>
                    <ul class="pricing-table__item-features">
                        <li><span class="text-marked">Concept development<br>UI design</span></li>
                        <li><span class="text-marked">Configuration management</span></li>
                        <li><span class="text-marked">Software quality assurance</span></li>
                        <li><span class="text-marked">App integration</span></li>
                    </ul>
                    <div class="pricing-table__item-control"><a class="button button-default button-ujarak" href="#">Order now</a></div>
                </article>
            </div>
        </div>
    </section>
    <!-- Pricing Tables-->
    <section class="section section-md bg-gray-light text-center">
        <div class="container">
            <h2>#2</h2>
            <div class="row row-30 justify-content-md-center">
                <div class="col-md-6 col-lg-4">
                    <!-- Pricing table item-->
                    <article class="pricing-table__item pricing-table-modern__item">
                        <div class="pricing-table__item-header">
                            <div class="pricing-table__item-header-bg">
                                <div class="pricing-table__item-header-bg-inner"></div>
                            </div>
                            <p class="pricing-table__item-title">Basic</p>
                        </div>
                        <div class="pricing-table__item-main">
                            <div class="pricing-table__item-price"><span class="pricing-table__item-price-currency">$</span><span class="pricing-table__item-price-value">399</span>
                                <div class="pricing-table__item-price-aside"><span class="top">99</span></div>
                            </div>
                            <div class="pricing-table__item-divider"></div>
                            <ul class="pricing-table__item-features">
                                <li><span class="text-marked">Concept development</span></li>
                                <li><span class="text-marked">UI design</span></li>
                                <li><span>Configuration management</span></li>
                                <li><span>Software quality assurance</span></li>
                            </ul>
                            <div class="pricing-table__item-control"><a class="button button-default button-ujarak" href="#">Order now</a></div>
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-lg-4">
                    <!-- Pricing table item-->
                    <article class="pricing-table__item pricing-table-modern__item pricing-table-modern__item_prefered">
                        <div class="pricing-table__item-header">
                            <div class="pricing-table__item-header-bg">
                                <div class="pricing-table__item-header-bg-inner"></div>
                            </div>
                            <p class="pricing-table__item-title">Optimal</p>
                        </div>
                        <div class="pricing-table__item-main">
                            <div class="pricing-table__item-price"><span class="pricing-table__item-price-currency">$</span><span class="pricing-table__item-price-value">599</span>
                                <div class="pricing-table__item-price-aside"><span class="top">99</span></div>
                            </div>
                            <div class="pricing-table__item-divider"></div>
                            <ul class="pricing-table__item-features">
                                <li><span class="text-marked">Concept development</span></li>
                                <li><span class="text-marked">UI design</span></li>
                                <li><span class="text-marked">Configuration management</span></li>
                                <li><span>Software quality assurance</span></li>
                            </ul>
                            <div class="pricing-table__item-control"><a class="button button-primary button-ujarak" href="#">Order now</a></div>
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-lg-4">
                    <!-- Pricing table item-->
                    <article class="pricing-table__item pricing-table-modern__item">
                        <div class="pricing-table__item-header">
                            <div class="pricing-table__item-header-bg">
                                <div class="pricing-table__item-header-bg-inner"></div>
                            </div>
                            <p class="pricing-table__item-title">Ultimate</p>
                        </div>
                        <div class="pricing-table__item-main">
                            <div class="pricing-table__item-price"><span class="pricing-table__item-price-currency">$</span><span class="pricing-table__item-price-value">999</span>
                                <div class="pricing-table__item-price-aside"><span class="top">99</span></div>
                            </div>
                            <div class="pricing-table__item-divider"></div>
                            <ul class="pricing-table__item-features">
                                <li><span class="text-marked">Concept development</span></li>
                                <li><span class="text-marked">UI design</span></li>
                                <li><span class="text-marked">Configuration management</span></li>
                                <li><span class="text-marked">Software quality assurance</span></li>
                            </ul>
                            <div class="pricing-table__item-control"><a class="button button-default button-ujarak" href="#">Order now</a></div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
    <!-- Pricing Tables-->
    <section class="section section-md bg-gray-light text-center">
        <div class="container">
            <h2>#3</h2>
            <div class="pricing-table pricing-table-creative">
                <!-- Pricing table item-->
                <article class="pricing-table__item pricing-table-creative__item">
                    <div class="pricing-table__item-inner">
                        <p class="pricing-table__item-title">Basic</p>
                        <div class="pricing-table__item-price">
                            <p class="pricing-table__item-price-value"><span class="small">$</span><span>399.99</span></p>
                            <p class="pricing-table__item-price-details">starting at</p>
                        </div>
                        <div class="pricing-table__item-control">
                            <div class="button-wrap"><a class="button btn-primary-outline button-ujarak" href="#">Order now</a></div>
                        </div>
                        <ul class="pricing-table__item-features">
                            <li><span class="text-marked">Concept development</span></li>
                            <li><span class="text-marked">UI design</span></li>
                            <li><span>Configuration management</span></li>
                            <li><span>Software quality assurance</span></li>
                        </ul>
                    </div>
                </article>
                <!-- Pricing table item-->
                <article class="pricing-table__item pricing-table-creative__item pricing-table-creative__item_prefered">
                    <div class="pricing-table__item-inner">
                        <p class="pricing-table__item-title">Optimal</p>
                        <div class="pricing-table__item-price">
                            <p class="pricing-table__item-price-value"><span class="small">$</span><span>599.99</span></p>
                            <p class="pricing-table__item-price-details">starting at</p>
                        </div>
                        <div class="pricing-table__item-control">
                            <div class="button-wrap"><a class="button btn-white-outline button-ujarak" href="#">Order now</a></div>
                        </div>
                        <ul class="pricing-table__item-features">
                            <li><span class="text-marked">Concept development</span></li>
                            <li><span class="text-marked">UI design</span></li>
                            <li><span class="text-marked">Configuration management</span></li>
                            <li><span class="text-accent">Software quality assurance</span></li>
                        </ul>
                    </div>
                </article>
                <!-- Pricing table item-->
                <article class="pricing-table__item pricing-table-creative__item">
                    <div class="pricing-table__item-inner">
                        <p class="pricing-table__item-title">Ultimate</p>
                        <div class="pricing-table__item-price">
                            <p class="pricing-table__item-price-value"><span class="small">$</span><span>999.99</span></p>
                            <p class="pricing-table__item-price-details">starting at</p>
                        </div>
                        <div class="pricing-table__item-control">
                            <div class="button-wrap"><a class="button btn-primary-outline button-ujarak" href="#">Order now</a></div>
                        </div>
                        <ul class="pricing-table__item-features">
                            <li><span class="text-marked">Concept development</span></li>
                            <li><span class="text-marked">UI design</span></li>
                            <li><span class="text-marked">Configuration management</span></li>
                            <li><span class="text-marked">Software quality assurance</span></li>
                        </ul>
                    </div>
                </article>
            </div>
        </div>
    </section>
@endsection
