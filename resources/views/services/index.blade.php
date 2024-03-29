@extends('layouts.main')
@section('title', 'DigiSpace | Services')
@section('content')
    <!-- Get a Domain Name-->
    <!-- Breadcrumbs-->
    <section class="breadcrumbs-custom">
        <div class="breadcrumbs-custom__aside bg-image context-dark"
             style="background-image: url({{ asset("images/services-page-title-bg.jpg") }});">
            <div class="container">
                <h2 class="breadcrumbs-custom__title">Services</h2>
            </div>
        </div>
        <div class="breadcrumbs-custom__main bg-gray-light">
            <div class="container">
                <ul class="breadcrumbs-custom__path">
                    <li><a href="{{ route('home.index') }}">Home</a></li>
                    <li class="active">Services</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="section section-lg text-center">
        <div class="container">
            <h2>Service packages</h2>
            <x-price-of-services :$products></x-price-of-services>
        </div>
    </section>
    @if(false)
        <section class="section section-lg text-center">
            <div class="container">
                <h2>List of services</h2>
                <x-list-of-services :$listOfServices></x-list-of-services>
            </div>
        </section>
    @endif
    <section class="section section-sm bg-white text-center">
        <div class="container">
            <x-choose-us-component :$chooseUsCategory :$chooseUsWidgets/>
        </div>
    </section>
    <!-- Your Questions-->
    <section class="section section-md bg-gray-light text-center">
        <div class="container">
            <h2>{{ $answerQuestionCategory->name }}</h2>
            <!-- Bootstrap collapse-->
            <div class="card-group card-group-custom card-group-corporate" id="accordion1" role="tablist"
                 aria-multiselectable="true">
                <div class="row row-30">
                    <div class="col-md-6">
                        @foreach($questionsLeft->widgets as $widget)
                            <!-- Bootstrap card-->
                            <div class="card card-custom card-corporate">
                                <div class="card-heading" id="accordion1Heading{{$widget->id}}" role="tab">
                                    <div class="card-title">
                                        <a class="@if(!$widget->css_class){{"collapsed"}}@endif"
                                           role="button" data-bs-toggle="collapse"
                                           data-bs-parent="#accordion1"
                                           href="#accordion1Collapse{{$widget->id}}"
                                           aria-controls="accordion1Collapse{{$widget->id}}"
                                           aria-expanded="true">{{ $widget->title }}
                                            <div class="card-arrow"></div>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-collapse collapse {{ $widget->css_class }}"
                                     id="accordion1Collapse{{$widget->id}}" role="tabpanel"
                                     aria-labelledby="accordion1Heading{{$widget->id}}">
                                    <div class="card-body">{!! $widget->content !!}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-6">
                        @foreach($questionsRight->widgets as $widget)
                            <!-- Bootstrap card-->
                            <div class="card card-custom card-corporate">
                                <div class="card-heading" id="accordion1Heading{{$widget->id}}" role="tab">
                                    <div class="card-title">
                                        <a class="collapsed" role="button" data-bs-toggle="collapse"
                                           data-bs-parent="#accordion1"
                                           href="#accordion1Collapse{{$widget->id}}"
                                           aria-controls="accordion1Collapse{{$widget->id}}"
                                           aria-expanded="true">{{ $widget->title }}
                                            <div class="card-arrow"></div>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-collapse collapse {{ $widget->css_class }}"
                                     id="accordion1Collapse{{$widget->id}}" role="tabpanel"
                                     aria-labelledby="accordion1Heading{{$widget->id}}">
                                    <div class="card-body">{!! $widget->content !!}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
