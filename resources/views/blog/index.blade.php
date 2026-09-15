@extends('layouts.main')
@section('title', __('site.blog_title'))

@php
    $p = (int) request('page', 1);
    $base = isset($category)
        ? route('blog-category', $category->slug)
        : route('blog');
@endphp


@section('content')
    <!-- Breadcrumbs-->
    <section class="breadcrumbs-custom">
        <div class="breadcrumbs-custom__aside bg-image context-dark"
             style="background-image: url({{ asset('images/bg-blog-post.jpg')}});">
            <div class="container">
                <h2 class="breadcrumbs-custom__title">{{ __('site.blog') }}</h2>
            </div>
        </div>
        <div class="breadcrumbs-custom__main bg-gray-light">
            <div class="container">
                <ul class="breadcrumbs-custom__path">
                    <li><a href="{{ route('home.index') }}">{{ __('site.home') }}</a></li>
                    @if(isset($category) || isset($archive))
                        <li><a href="{{ route('blog') }}"> Blog</a></li>
                    @else
                        <li class="active">{{ __('site.blog') }}</li>
                    @endif
                    @if(isset($category))
                        <li class="active">{{ $category->name }}</li>
                    @endif
                    @if(isset($archive))
                        <li class="active">{{ $archive }}</li>
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
                    @foreach($posts as $post)
                        <!-- Post Classic-->
                        <article class="post-classic">
                            <h3 class="post-classic__title">
                                <a href="{{ route('blog.post', $post->slug) }}">{{ $post->name }}</a>
                            </h3>
                            <ul class="post-classic__meta">
                                <li>
                                    <span class="icon mdi mdi-calendar-blank"></span>
                                    <a href="{{ route('blog.post', $post->slug) }}">
                                        <time datetime="{{ Carbon\Carbon::parse($post->created_at)->format('Y') }}">
                                            {{ Carbon\Carbon::parse($post->created_at)->toFormattedDateString()  }}
                                        </time>
                                    </a>
                                </li>
                                <li>
                                    <span class="icon mdi mdi-format-list-bulleted"></span>
                                    <a href="{{ route('blog-category', $post->category->slug) }}">
                                        {{ $post->category->name }}
                                    </a>
                                </li>
                                @if(isset($post->user->name))
                                    <li>
                                        <span class="icon mdi mdi-account"></span>
                                        <span>{{ __('site.by') }}</span>
                                        <span>{{ $post->user->name }}</span>
                                    </li>
                                @endif
                            </ul>
                            <div class="post-classic__media">
                                <a class="post-classic__figure" href="{{ route('blog.post', $post->slug) }}">
                                    <img class="post-classic__image" src="{{ asset($post->img_path) }}"
                                         alt="{{ $post->name }}" width="715"
                                         height="417"/>
                                </a>
                            </div>
                            <p>{!! $post->content !!}</p>
                        </article>
                    @endforeach
                    <div class="pagination">
                        {!! $posts->links() !!}
                    </div>
                </div>
                <x-blog-aside :$sideBarData :$postsNumber :$banner></x-blog-aside>
            </article>
        </div>
    </section>
@endsection
