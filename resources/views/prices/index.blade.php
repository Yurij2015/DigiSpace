@extends('layouts.main')
@section('title', 'DigiSpace | Prices')
@section('content')
    <!-- Breadcrumbs-->
    <section class="breadcrumbs-custom">
        <div class="breadcrumbs-custom__aside bg-image context-dark"
             style="background-image: url({{ asset("images/bg-image-5-1920x1200.jpg") }});">
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
            <h2>{{ $page->name }}</h2>
            <h5>{{ $page->description }}</h5>
            <x-price-of-services :$products></x-price-of-services>
        </div>
    </section>
@endsection
