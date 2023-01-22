@extends('layouts.main')
@section('title', "DigiSpace | Blog - $slug")
@section('content')
    <!-- Breadcrumbs-->
    <section class="breadcrumbs-custom">
        <div class="breadcrumbs-custom__aside bg-image context-dark"
             style="background-image: url({{ asset('images/bg-image-15-1920x860.jpg')}});">
            <div class="container">
                <h2 class="breadcrumbs-custom__title">Post - {{ $slug }}</h2>
            </div>
        </div>
        <div class="breadcrumbs-custom__main bg-gray-light">
            <div class="container">
                <ul class="breadcrumbs-custom__path">
                    <li><a href="{{ route('home.index')}}">Home</a></li>
                    <li>Blog</li>
                    <li>Post</li>
                    <li class="active">{{ $slug }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Page -->
    <section class="section section-lg bg-white text-center">
        <div class="container">
            <h1>{{ $slug }}</h1>
        </div>
    </section>
@endsection
