@extends('layouts.main')
@section('title', 'DigiSpace | Blog')
@section('content')
    <!-- Breadcrumbs-->
    <section class="breadcrumbs-custom">
        <div class="breadcrumbs-custom__aside bg-image context-dark"
             style="background-image: url({{ asset('images/bg-image-15-1920x860.jpg')}});">
            <div class="container">
                <h2 class="breadcrumbs-custom__title">Blog</h2>
            </div>
        </div>
        <div class="breadcrumbs-custom__main bg-gray-light">
            <div class="container">
                <ul class="breadcrumbs-custom__path">
                    <li><a href="{{ route('home.index')}}">Home</a></li>
                    <li class="active">Blog</li>
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
                                        <span>by</span>
                                        <a href="#">{{ $post->user->name }}</a>
                                    </li>
                                @endif
                            </ul>
                            <div class="post-classic__media">
                                <a class="post-classic__figure" href="{{ route('blog.post', $post->slug) }}">
                                    <img class="post-classic__image" src="{{ asset($post->img_path) }}"
                                         alt="" width="715"
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
