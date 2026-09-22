@extends('layouts.main')
@section('title', __('site.page_title', ['name' => $serviceCategory->seo_title ?: $serviceCategory->name]))
@section('content')
    @php($serviceAssetVersion = '20260922-2')
    <!-- Breadcrumbs-->
    <section class="breadcrumbs-custom">
        <div class="breadcrumbs-custom__aside bg-image context-dark"
             style="background-image: url({{ asset("images/services-page-title-bg.jpg") }});">
            <div class="container">
                <h1 class="breadcrumbs-custom__title">{{ $serviceCategory->name ?? __('site.category_services') }}</h1>
            </div>
        </div>
        <div class="breadcrumbs-custom__main bg-gray-light">
            <div class="container">
                <ul class="breadcrumbs-custom__path">
                    <li><a href="{{ route('home.index') }}">{{ __('site.home') }}</a></li>
                    @if(isset($serviceCategory))
                        <li><a href="{{ route('services') }}">{{ __('site.services') }}</a></li>
                        <li class="active">{{ $serviceCategory->name }}</li>
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
                    @foreach($services as $item)
                        <!-- Post Classic-->
                        <article class="post-single">
                            <h2 class="post-single__title service-category__title">
                                <a href="{{ route('category-service', [$serviceCategory->slug, $item->slug]) }}">{{ $item->title }}</a>
                            </h2>
                            <ul class="post-classic__meta">
                                <li>
                                    <span class="icon mdi mdi-format-list-bulleted"></span>
                                    {{ __('site.service_category') }}: {{ $serviceCategory->name }}
                                </li>
                            </ul>
                            <div class="post-classic__media">
                                <a href="{{ route('category-service', [$serviceCategory->slug, $item->slug]) }}">
                                    <img class="post-classic__image" src="{{ asset($item->image) }}?v={{ $serviceAssetVersion }}"
                                         alt="{{ $item->image_alt ?: $item->title }}" width="715"
                                         sizes="(max-width: 767px) calc(100vw - 32px), 715px"
                                         loading="lazy" decoding="async"/>
                                </a>
                            </div>
                            <p>{{ $item->seo_description }}</p>
                            <a class="button button-sm button-default button-ujarak"
                               href="{{ route('category-service', [$serviceCategory->slug, $item->slug]) }}">{{ __('site.read_more') }}</a>
                        </article>
                    @endforeach
                    <div class="pagination">
                        {!! $services->links() !!}
                    </div>
                    <div class="service-article__cta">
                        <a class="button button-primary button-ujarak" href="{{ route('contact-us') }}">
                            {{ __('site.contact_us') }}
                        </a>
                    </div>
                </div>
                <x-service-aside :$serviceCategories></x-service-aside>
            </article>
        </div>
    </section>
@endsection
