@extends('layouts.main')
@section('title', 'DigiSpace | Contact Us')
@section('content')
    <!-- Breadcrumbs-->
    <section class="breadcrumbs-custom">
        <div class="breadcrumbs-custom__aside bg-image context-dark"
             style="background-image: url({{ asset('images/bg-contact-us.jpg') }});">
            <div class="container">
                <h2 class="breadcrumbs-custom__title">{{ $page->name }}</h2>
            </div>
        </div>
        <div class="breadcrumbs-custom__main bg-gray-light">
            <div class="container">
                <ul class="breadcrumbs-custom__path">
                    <li><a href="{{ route('home.index') }}">Home</a></li>
                    <li class="active">{{ $page->name }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Contact Form -->
    <section class="section section-md bg-white">
        <div class="container container_bigger">
            <div class="row justify-content-md-center justify-content-xl-between row-2-columns-bordered row-50">
                @foreach($contactUs->widgets as $widget)
                    @php($content = json_decode($widget->content, false, 512, JSON_THROW_ON_ERROR))
                    <div class="col-md-10 col-lg-5">
                        <h3>{{ $widget->title }}</h3>
                        <ul class="list-creative">
                            <li>
                                <dl class="list-terms-medium list-terms-medium_secondary">
                                    <dt>{{ $content->address->name }}</dt>
                                    <dd><a href="#">{{ $content->address->value }}</a></dd>
                                </dl>
                            </li>
                            <li>
                                <dl class="list-terms-medium">
                                    <dt>{{ $content->phones->name }}</dt>
                                    <dd>
                                        <ul class="list-comma">
                                            <li><a href="tel:#">{{ $content->phones->value->first }}</a></li>
                                            <li><a href="tel:#">{{ $content->phones->value->second }}</a></li>
                                        </ul>
                                    </dd>
                                </dl>
                            </li>
                            <li>
                                <dl class="list-terms-medium list-terms-medium_tertiary">
                                    <dt>{{ $content->emails->name }}</dt>
                                    <dd>
                                        <ul class="list-comma">
                                            <li><a href="mailto:#">{{ $content->emails->value->first }}</a></li>
                                            <li><a href="mailto:#">{{ $content->emails->value->second }}</a></li>
                                        </ul>
                                    </dd>
                                </dl>
                            </li>
                        </ul>
                    </div>
                @endforeach
                <div class="col-md-10 col-lg-7 col-xl-6">
                    <x-contact-form></x-contact-form>
                </div>
            </div>
        </div>
    </section>
    {{--    <x-google-map></x-google-map>--}}
@endsection
