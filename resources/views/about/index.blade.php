@extends('layouts.main')
@section('title', 'DigiSpace | About')
@section('content')
    <!-- Breadcrumbs-->
    <section class="breadcrumbs-custom">
        <div class="breadcrumbs-custom__aside bg-image context-dark"
             style="background-image: url({{ asset('images/bg-about-page.jpeg') }});">
            <div class="container">
                <h2 class="breadcrumbs-custom__title">About</h2>
            </div>
        </div>
        <div class="breadcrumbs-custom__main bg-gray-light">
            <div class="container">
                <ul class="breadcrumbs-custom__path">
                    <li><a href="{{ route('home.index') }}">Home</a></li>
                    <li class="active">About</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- General Info-->
    <section class="section section-lg bg-white">
        <div class="container">
            <div class="row row-50 justify-content-md-center justify-content-lg-start">
                <div class="col-md-10 col-lg-6">
                    <div class="image-custom-1">
                        <img src="{{ asset('images/web-development.jpg') }}" alt="" width="602" height="359"/>
                    </div>
                </div>
                <div class="col-md-10 col-lg-6">
                    <div class="box-inset-1">
                        <!-- Bootstrap tabs -->
                        <div class="tabs-custom tabs-horizontal tabs-corporate tabs-corporate_left" id="tabs-about">
                            <!-- Nav tabs-->
                            <ul class="nav nav-tabs">
                                @foreach ($aboutPageGeneralInfo['widgets'] as $widget)
                                    <li class="nav-item">
                                        <a class="nav-link {{ $widget->css_class }}" href="{{ $widget->anchor }}"
                                           data-bs-toggle="tab">{{ $widget->title }}</a></li>
                                @endforeach
                            </ul>
                            <!-- Tab panes-->
                            <div class="tab-content">
                                @foreach ($aboutPageGeneralInfo['widgets'] as $widget)
                                    <div class="tab-pane fade {{ $widget->css_class }}"
                                         id="{{ $widget->element_id }}">
                                        <h4>{{ $widget->subtitle }}</h4>
                                        {!! $widget->content !!}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Team-->
    @if(false)
        <section class="section section-lg bg-gray-light text-center">
            <div class="container">
                <h2> {{ $teamInfoCategoryTitle }}</h2>
                <div class="row row-50">
                    @foreach( $teamInfo['widgets'] as $widget )
                        <div class="col-md-6 col-lg-4">
                            <!-- Card Creative-->
                            <article class="card-creative">
                                <div class="card-creative__inner">
                                    <figure class="card-creative__media"><img src="{{ asset($widget->widget_image) }}"
                                                                              alt="" width="230" height="211"/>
                                    </figure>
                                    <p class="card-creative__title">{{ $widget->title }}</p>
                                    <p class="card-creative__subtitle">{{ $widget->subtitle }}</p>
                                    <div class="card-creative__divider"></div>
                                    <div class="card-creative__aside">
                                        <ul class="list-inline list-inline-md">
                                            @foreach($widget->widgetIcon as $icon)
                                                <li>
                                                    <a class="icon icon-xs icon-darker icon-style-brand {{ $icon->icon_class }}"
                                                       href="#">
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!-- Facts-->
    <section class="section parallax-container bg-gray-darker"
             data-parallax-img="{{ asset($someFactsAboutCategory->image) }}">
        <div class="parallax-content">
            <div class="section-lg text-center">
                <div class="container">
                    <h2>{{ $someFactsAboutCategory->name }}</h2>
                    <p class="text-style-1"> {{ $someFactsAboutCategory->description }}</p>
                    <div class="row row-30 offset-top-1">
                        @foreach( $someFactsAbout['widgets'] as $widget )
                            <div class="col-sm-6 col-md-3">
                                <!--Counter-->
                                <article class="box-counter">
                                    <div class="box-counter__main">
                                        <div class="counter-prefix">{{ $widget->subtitle }}</div>
                                        <div class="counter">{{ $widget->content }}</div>
                                        <div class="small">{{ $widget->icon }}</div>
                                    </div>
                                    <div class="box-counter__divider"></div>
                                    <p class="box-counter__title">{{ $widget->title }}</p>
                                </article>
                            </div>
                        @endforeach
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
            <x-our-projects :$clientsCategory :$clients></x-our-projects>
        </div>
    </section>
    <!-- Technologies -->
    <x-technologies></x-technologies>
@endsection
