@extends('layouts.main')
@section('title', 'DigiSpace | About')
@section('content')
    <!-- Breadcrumbs-->
    <section class="breadcrumbs-custom">
        <div class="breadcrumbs-custom__aside bg-image context-dark"
             style="background-image: url({{ asset('images/bg-about-page.jpeg') }});">
            <div class="container">
                <h2 class="breadcrumbs-custom__title">Pages</h2>
            </div>
        </div>
        <div class="breadcrumbs-custom__main bg-gray-light">
            <div class="container">
                <ul class="breadcrumbs-custom__path">
                    <li><a href="{{ route('home.index') }}">Home</a></li>
                    <li class="active">Pages</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- 404-->
    <section class="section section-md bg-white text-center">
        <div class="container">
            <h3>Sorry, but the page was not found </h3>
            <p class="ls-05">You may have mistyped the address or the page may have moved</p>
            <div class="group-sm group-middle">
                <a class="button button-primary button-ujarak" href="{{ route('home.index') }}">
                    Go to home page
                </a>
                <a class="button button-default button-ujarak" href="{{ route('blog') }}">Go to blog</a>
            </div>
        </div>
    </section>
@endsection
