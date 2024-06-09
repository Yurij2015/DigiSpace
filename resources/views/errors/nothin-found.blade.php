@extends('layouts.main')
@section('title', 'DigiSpace | Service Search')
@section('content')
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
    <!-- 404-->
    <section class="section section-md bg-white text-center">
        <div class="container">
            <h3>Sorry, your search did not find anything </h3>
            <p class="ls-05">The service you are looking for is not in the system</p>
            <div class="group-sm group-middle">
                <a class="button button-primary button-ujarak" href="{{ route('home.index') }}">
                    Go to the home page
                </a>
                <a class="button button-default button-ujarak" href="{{ route('services') }}">Go to the services page</a>
            </div>
        </div>
    </section>
@endsection
