@extends('layouts.main')
@section('content')
    <!-- Breadcrumbs-->
    <section class="breadcrumbs-custom">
        <div class="breadcrumbs-custom__aside bg-image context-dark"
             style="background-image: url({{ asset('images/bg-promos.jpg') }});">
            <div class="container">
                <h2 class="breadcrumbs-custom__title">{{ $promosCategory->name }}</h2>
            </div>
        </div>
        <div class="breadcrumbs-custom__main bg-gray-light">
            <div class="container">
                <ul class="breadcrumbs-custom__path">
                    <li><a href="{{ route('home.index') }}">Home</a></li>
                    <li class="active">{{ $promosCategory->name }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Promos-->
    <section class="section section-md bg-white text-center">
        <div class="container">
            <h5>{{ $page->description }}</h5>
            <div class="row row-30">
                @foreach($promosWidgets->widgets as $widget)
                    @php($content = json_decode($widget->content, false, 512, JSON_THROW_ON_ERROR))
                    <div class="col-md-6 col-lg-4">
                        <!-- Promo Classic-->
                        <article class="promo-classic">
                            <div class="promo-classic__inner">
                                <div class="promo-classic__icon-wrap">
                                    <div class="promo-classic__icon">
                                        <span class="{{ $widget->icon }}"></span>
                                    </div>
                                </div>
                                <div class="promo-classic__main">
                                    <div class="promo-classic__label {{ $widget->css_class }}">
                                        <svg class="promo-classic__label-svg" x="0px" y="0px" width="51px" height="23px"
                                             viewbox="0 0 51 23" preserveAspectRatio="xMaxYMin">
                                            <polygon
                                                points="0.012,0.006 0.012,22.995 43.991,22.995 43.991,23 50.988,11.5 43.991,0 43.991,0.006 "></polygon>
                                        </svg>
                                        <span>{{ $content->discount }}</span>
                                    </div>
                                    <h4 class="promo-classic__title">{{ $widget->title }}</h4>
                                    <div class="promo-classic__divider"></div>
                                    <div class="promo-classic__price">
                                        <span class="promo-classic__price-currency">{{ $content->currency }}</span>
                                        <span class="promo-classic__price-value">{{ $content->price_value }}</span>
                                        <div class="promo-classic__price-aside">
                                            <span class="top">{{ $content->price_aside }}</span>
                                            <span class="bottom">{{ $content->period }}</span>
                                        </div>
                                    </div>
                                    <p class="promo-classic__price-old">{{ $content->price_old }}</p>
                                    <div class="promo-classic__control">
                                        <a class="button button-primary button-ujarak" href="#">Order now</a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

