@extends('layouts.main')
@section('title', "DigiSpace | $page->name")
@section('content')
    <!-- Breadcrumbs-->
    <section class="breadcrumbs-custom">
        <div class="breadcrumbs-custom__aside bg-image context-dark"
             style="background-image: url({{ asset('images/bg-image-15-1920x860.jpg')}});">
            <div class="container">
                <h1 class="post-title">{{ $page->name }}</h1>
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
    <section class="section section-lg bg-white">
        <div class="container">
            <article class="post-layout">
                <div class="blog-layout__main">
                    <article class="post-single">
                        <div class="quote-classic quote-classic_secondary">
                            <p>{!! $page->content !!}</p>
                        </div>
                    </article>
                </div>
            </article>
        </div>
    </section>
@endsection
<style>
    .post-title {
        font-size: 28px;
    }
</style>
