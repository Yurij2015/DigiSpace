@extends('layouts.main')
@section('title', "DigiSpace | Blog - $post->name")
@section('content')
    <!-- Breadcrumbs-->
    <section class="breadcrumbs-custom">
        <div class="breadcrumbs-custom__aside bg-image context-dark"
             style="background-image: url({{ asset('images/bg-image-15-1920x860.jpg')}});">
            <div class="container">
                <h2 class="breadcrumbs-custom__title">{{ $post->name }}</h2>
            </div>
        </div>
        <div class="breadcrumbs-custom__main bg-gray-light">
            <div class="container">
                <ul class="breadcrumbs-custom__path">
                    <li><a href="{{ route('home.index')}}">Home</a></li>
                    <li><a href="{{ route('blog') }}"> Blog</a></li>
                    <li class="active">{{ $post->name }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Blog post-->
    <section class="section section-lg bg-white">
        <div class="container">
            <article class="blog-layout">
                <div class="blog-layout__main">
                    <article class="post-single">
                        <div class="post-single__header">
                            <ul class="post-single__meta">
                                <li><span class="icon mdi mdi-comment-outline"></span><a href="#">3</a></li>
                                <li><span class="icon mdi mdi-thumb-up-outline"></span><a href="#">12</a></li>
                            </ul>
                            <ul class="post-single__meta">
                                <li><span class="icon mdi icon mdi mdi-account"></span>
                                    <span>by</span>
                                    <a href="#">{{ $post->user->name }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="post-single__time-wrap">
                            <time class="post-single__time"
                                  datetime="{{ Carbon\Carbon::parse($post->created_at)->format('Y') }}">
                                <span class="post-single__time-day">
                                    {{ Carbon\Carbon::parse($post->created_at)->format('d') }}
                                </span>
                                <span class="post-single__time-month">
                                    {{ Carbon\Carbon::parse($post->created_at)->format('M') }}
                                </span>
                            </time>
                        </div>
                        <h4 class="post-single__title">{{ $post->name }}</h4>
                        <img src="{{ asset($post->img_path) }}" alt="" width="715" height="417"/>
                        <article class="quote-classic quote-classic_secondary">
                            <p>{!! $post->content !!}</p>
                        </article>

                        <div class="post-single__footer">
                            <div class="post-single__footer-inner">
                                <h5>Share this post</h5>
                                <ul class="list-inline list-inline-xs">
                                    <li><a class="icon icon-xs icon-gray-dark fa fa-facebook" href="#"></a></li>
                                    <li><a class="icon icon-xs icon-gray-dark fa fa-twitter" href="#"></a></li>
                                    <li><a class="icon icon-xs icon-gray-dark fa fa-google-plus" href="#"></a></li>
                                    <li><a class="icon icon-xs icon-gray-dark fa fa-pinterest-p" href="#"></a></li>
                                </ul>
                            </div>
                        </div>
                    </article>
                    <div class="section-md section-collapse">
                        <p class="custom-heading-line heading-8">Recent posts</p>
                        <div class="row row-50">
                            <div class="col-md-6">
                                <!-- Post Minimal-->
                                <article class="post-minimal"><a class="post-minimal__media" href="blog-post.html"><img
                                            class="post-minimal__image"
                                            src="{{ asset('images/single-post-2-368x293.jpg') }}" alt=""
                                            width="368" height="293"/>
                                    </a>
                                    <h4 class="post-minimal__title">
                                        <a href="blog-post.html">
                                            Key Considerations and Warnings of iPaaS
                                        </a></h4>
                                    <ul class="post-minimal__meta">
                                        <li>
                                            <span class="icon mdi mdi-comment-outline"></span>
                                            <a href="blog-post.html">450</a>
                                        </li>
                                        <li>
                                            <span class="icon mdi mdi-thumb-up-outline"></span>
                                            <a href="#">12</a>
                                        </li>
                                        <li>
                                            <span class="icon mdi mdi-account"></span>
                                            <span>by</span><a href="#">John
                                                Doe</a></li>
                                    </ul>
                                </article>
                            </div>
                            <div class="col-md-6">
                                <!-- Post Minimal-->
                                <article class="post-minimal"><a class="post-minimal__media" href="blog-post.html"><img
                                            class="post-minimal__image"
                                            src="{{ asset('images/single-post-3-368x293.jpg') }}" alt=""
                                            width="368" height="293"/></a>
                                    <h4 class="post-minimal__title"><a href="blog-post.html">Usage of Hibernate Query
                                            Language (HQL)</a></h4>
                                    <ul class="post-minimal__meta">
                                        <li><span class="icon mdi mdi-comment-outline"></span>
                                            <a href="blog-post.html">450</a>
                                        </li>
                                        <li><span class="icon mdi mdi-thumb-up-outline"></span><a href="#">12</a></li>
                                        <li><span class="icon mdi mdi-account"></span>
                                            <span>by</span>
                                            <a href="#">John Doe</a>
                                        </li>
                                    </ul>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
                <x-blog-aside :$sideBarData :$postsNumber></x-blog-aside>
            </article>
        </div>
    </section>

@endsection
