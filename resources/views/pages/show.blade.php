@extends('layouts.main')
@section('title', "DigiSpace | $page->name")
@section('content')
    <!-- Breadcrumbs-->
    <section class="breadcrumbs-custom">
        <div class="breadcrumbs-custom__aside bg-image context-dark"
             style="background-image: url({{ asset('images/bg-image-15-1920x860.jpg')}});">
            <div class="container">
                <h2 class="breadcrumbs-custom__title">{{ $page->name }}</h2>
            </div>
        </div>
        <div class="breadcrumbs-custom__main bg-gray-light">
            <div class="container">
                <ul class="breadcrumbs-custom__path">
                    <li><a href="{{ route('home.index')}}">Home</a></li>
                    <li>Pages</li>
                    <li class="active">{{ $page->name }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Page title-->
    <section class="section section-xs bg-white text-center">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-9 col-lg-8 col-xl-6">
                    <h3>{{ $page->name }}</h3>
                    <p class="big">{!! $page->description !!}</p>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-xs bg-white">
        <div class="container grid-system-bordered grid-demonstration">
            <div class="row">
                <div class="col-10 offset-1">
                    <article class="quote-classic quote-classic_secondary">
                        {!! $page->content !!}
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection
