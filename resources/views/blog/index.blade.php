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
                    <!-- Post Classic-->
                    <article class="post-classic">
                        <h3 class="post-classic__title"><a href="blog-post.html">Benefits of Async/Await in
                                Programming</a></h3>
                        <ul class="post-classic__meta">
                            <li><span class="icon mdi mdi-calendar-blank"></span><a href="blog-post.html">
                                    <time datetime="2021">May 12, 2021</time>
                                </a></li>
                            <li><span class="icon mdi mdi-comment-outline"></span><a href="blog-post.html">450
                                    comments</a></li>
                            <li><span class="icon mdi mdi-account"></span><span>by</span><a href="#">John Doe</a></li>
                        </ul>
                        <div class="post-classic__media"><a class="post-classic__figure" href="blog-post.html"><img
                                    class="post-classic__image" src="{{ asset('images/blog-post-1-715x417.jpg') }}"
                                    alt="" width="715"
                                    height="417"/></a></div>
                    </article>
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
                    <!-- Post Classic-->
                    <article class="post-classic">
                        <h3 class="post-classic__title"><a href="blog-post.html">Usage of Hibernate Query Language
                                (HQL)</a></h3>
                        <ul class="post-classic__meta">
                            <li><span class="icon mdi mdi-calendar-blank"></span><a href="blog-post.html">
                                    <time datetime="2021">May 12, 2021</time>
                                </a></li>
                            <li><span class="icon mdi mdi-comment-outline"></span><a href="blog-post.html">450
                                    comments</a></li>
                            <li><span class="icon mdi mdi-account"></span><span>by</span><a href="#">John Doe</a></li>
                        </ul>
                        <div class="post-classic__media"><a class="post-classic__figure" href="blog-post.html"><img
                                    class="post-classic__image" src="{{ asset('images/blog-post-3-715x417.jpg') }}"
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
                <div class="blog-layout__aside">
                    <div class="blog-layout__aside-item">
                        <!-- RD Search-->
                        <form class="rd-search rd-search_inline form_lg form_outline" action="search-results.html"
                              method="GET">
                            <div class="form-wrap">
                                <label class="form-label" for="rd-search-blog-form-input">Search the blog...</label>
                                <input class="form-input" id="rd-search-blog-form-input" type="text" name="s"
                                       autocomplete="off">
                            </div>
                            <button class="button-link fl-budicons-launch-search81" type="submit"></button>
                        </form>
                    </div>
                    <div class="blog-layout__aside-item blog-layout__aside-item_bordered">
                        <p class="custom-heading-line heading-8">Categories</p>
                        <ul class="list-categories">
                            <li class="active"><a href="#">All categories</a><span class="count">64</span></li>
                            <li><a href="#">Software</a><span class="count">23</span></li>
                            <li><a href="#">Development</a><span class="count">10</span></li>
                            <li><a href="#">Programming</a><span class="count">10</span></li>
                        </ul>
                    </div>
                    <div class="blog-layout__aside-item blog-layout__aside-item_bordered">
                        <p class="custom-heading-line heading-8">Latest Posts</p>
                        <ul class="list-posts">
                            <li>
                                <!-- Post Line-->
                                <article class="post-line">
                                    <time class="post-line__time" datetime="2021"><span
                                            class="post-line__time-day">24</span><span
                                            class="post-line__time-month">may</span></time>
                                    <div class="post-line__title"><a href="blog-post.html">Startup Software
                                            Development</a></div>
                                </article>
                            </li>
                            <li>
                                <!-- Post Line-->
                                <article class="post-line">
                                    <time class="post-line__time" datetime="2021"><span
                                            class="post-line__time-day">12</span><span
                                            class="post-line__time-month">may</span></time>
                                    <div class="post-line__title"><a href="blog-post.html">Hybrid Cloud Management
                                            Software Solutions</a></div>
                                </article>
                            </li>
                            <li>
                                <!-- Post Line-->
                                <article class="post-line">
                                    <time class="post-line__time" datetime="2021"><span
                                            class="post-line__time-day">03</span><span
                                            class="post-line__time-month">may</span></time>
                                    <div class="post-line__title"><a href="blog-post.html">Creating Better Software
                                            Through Design Thinking</a></div>
                                </article>
                            </li>
                        </ul>
                    </div>
                    <div class="blog-layout__aside-item blog-layout__aside-item_bordered">
                        <p class="custom-heading-line heading-8">Archive</p>
                        <!-- Select 2-->
                        <select class="form-input select" data-placeholder="All"
                                data-minimum-results-for-search="Infinity">
                            <option>August 2021</option>
                            <option value="1">July 2021</option>
                            <option value="2">June 2021</option>
                            <option value="3">May 2021</option>
                            <option value="4">April 2021</option>
                            <option value="5">March 2021</option>
                        </select>
                    </div>
                    <div class="blog-layout__aside-item"><a class="link-banner" href="#"><img
                                src="{{ asset('images/banner-305x302.jpg') }}" alt="" width="305" height="302"/></a>
                    </div>
                </div>
            </article>
        </div>
    </section>
@endsection
