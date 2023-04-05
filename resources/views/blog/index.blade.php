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
{{--                                <a href="{{ $post['slug'] }}">{{ $post['name'] }}</a>--}}
                                <a href="{{ route('blog.post', $post['id']) }}">{{ $post['name'] }}</a>
                            </h3>
                            <ul class="post-classic__meta">
                                <li><span class="icon mdi mdi-calendar-blank"></span><a href="blog-post.html">
                                        <time datetime="2021">May 12, 2021</time>
                                    </a></li>
                                <li><span class="icon mdi mdi-comment-outline"></span><a href="blog-post.html">450
                                        comments</a></li>
                                <li><span class="icon mdi mdi-account"></span>
                                    <span>by</span><a href="#">John Doe</a></li>
                            </ul>
                            <div class="post-classic__media">
                                <a class="post-classic__figure" href="blog-post.html">
                                    <img class="post-classic__image" src="{{ asset($post['img_path']) }}"
                                         alt="" width="715"
                                         height="417"/>
                                </a>
                            </div>
                            <p>{!! $post['content'] !!}</p>
                        </article>
                    @endforeach

                    <!-- Post Classic-->
                    <article class="post-classic">
                        <h3 class="post-classic__title"><a href="blog-post.html">Key Considerations and Warnings of
                                iPaaS</a></h3>
                        <ul class="post-classic__meta">
                            <li><span class="icon mdi mdi-calendar-blank"></span><a href="blog-post.html">
                                    <time datetime="2021">May 12, 2021</time>
                                </a></li>
                            <li><span class="icon mdi mdi-comment-outline"></span><a href="blog-post.html">450
                                    comments</a></li>
                            <li><span class="icon mdi mdi-account"></span><span>by</span><a href="#">John Doe</a></li>
                        </ul>
                        <div class="post-classic__media"><a class="post-classic__figure" href="blog-post.html"><img
                                    class="post-classic__image" src="{{ asset('images/blog-post-2-715x417.png') }}"
                                    alt="" width="715"
                                    height="417"/></a></div>
                    </article>

                    <div class="pagination">
                        <div class="pagination__control"><a href="#">Older posts</a></div>
                        <ul class="pagination__list">
                            <li><a href="#">1</a></li>
                            <li class="active"><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                        </ul>
                        <div class="pagination__control"><a href="#">Newer posts</a></div>
                    </div>
                </div>
                <x-blog-aside :$sideBarData></x-blog-aside>
            </article>
        </div>
    </section>
@endsection
