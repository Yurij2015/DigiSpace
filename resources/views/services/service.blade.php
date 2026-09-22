@extends('layouts.main')
@section('title', __('site.page_title', ['name' => $service->seo_title ?: $service->title]))
@section('content')
    @php
        $serviceAssetVersion = '20260922-2';
        $serviceDescription = preg_replace(
            '/(src=["\']\/uploads\/services\/[^"\']+)(["\'])/i',
            '$1?v='.$serviceAssetVersion.'$2',
            $service->description,
        );
    @endphp
    <!-- Breadcrumbs-->
    <section class="breadcrumbs-custom">
        <div class="breadcrumbs-custom__aside bg-image context-dark"
             style="background-image: url({{ asset("images/services-page-title-bg.jpg") }});">
            <div class="container">
                <h1 class="breadcrumbs-custom__title">{{ $service->title }}</h1>
            </div>
        </div>
        <div class="breadcrumbs-custom__main bg-gray-light">
            <div class="container">
                <ul class="breadcrumbs-custom__path">
                    <li><a href="{{ route('home.index') }}">{{ __('site.home') }}</a></li>
                    @if(isset($serviceCategory))
                        <li><a href="{{ route('services') }}">{{ __('site.services') }}</a></li>
                        <li><a href="{{ route('category-services', $serviceCategory->slug) }}">{{ $serviceCategory->name }}</a></li>
                        <li class="active">{{ $service->title }}</li>
                    @endif
                </ul>
            </div>
        </div>
    </section>
    <!-- Blog-->
    <section class="section section-lg bg-white text-center">
        <div class="container">
            <article class="blog-layout">
                <div class="blog-layout__main">
                        <!-- Post Classic-->
                        <article class="post-single">
                            <h2 class="post-single__title">
                                {{ $service->title }}
                            </h2>
                            <ul class="post-classic__meta">
                                <li>
                                    <span class="icon mdi mdi-format-list-bulleted"></span>
                                    <a href="{{ route('category-services', $serviceCategory->slug) }}">{{ __('site.service_category') }}: {{ $serviceCategory->name }}</a>
                                </li>
                            </ul>
                            <p>{{ $service->seo_description }}</p>
                            <div class="post-classic__media">
                                <img class="post-classic__image" src="{{ asset($service->image) }}?v={{ $serviceAssetVersion }}"
                                     alt="{{ $service->image_alt ?: $service->title }}" width="715"
                                     sizes="(max-width: 767px) calc(100vw - 32px), 715px"
                                     loading="eager" fetchpriority="high" decoding="async"/>
                            </div>
                            <div class="service-article__body">
                                {!! preg_replace('/<p>(\s*<img[^>]+src=["\']\/uploads\/services\/[^>]+\/?>(?:\s*)<\/p>)/i', '<figure class="service-diagram">$1</figure>', $serviceDescription) !!}
                            </div>
                            <div class="service-article__cta">
                                <a class="button button-primary button-ujarak" href="{{ route('contact-us') }}">
                                    {{ __('site.contact_us') }}
                                </a>
                            </div>
                        </article>
                </div>
                <x-service-aside :$serviceCategories></x-service-aside>
            </article>
        </div>
    </section>
@endsection
