@extends('layouts.main')
@section('title', "DigiSpace | Blog - $slug")
@section('content')
    <!-- Breadcrumbs-->
    <section class="breadcrumbs-custom">
        <div class="breadcrumbs-custom__aside bg-image context-dark"
             style="background-image: url({{ asset('images/bg-image-15-1920x860.jpg')}});">
            <div class="container">
                <h2 class="breadcrumbs-custom__title">{{ $slug }}</h2>
            </div>
        </div>
        <div class="breadcrumbs-custom__main bg-gray-light">
            <div class="container">
                <ul class="breadcrumbs-custom__path">
                    <li><a href="{{ route('home.index')}}">Home</a></li>
                    <li>Blog</li>
                    <li class="active">{{ $slug }}</li>
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
                                    <a href="#">John Doe</a>
                                </li>
                            </ul>
                        </div>
                        <div class="post-single__time-wrap">
                            <time class="post-single__time" datetime="2021"><span
                                    class="post-single__time-day">25</span><span
                                    class="post-single__time-month">June</span></time>
                        </div>
                        <h4 class="post-single__title">Benefits Of Async/Await In Asynchronous Programming: Expert
                            Opinion</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                            voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                            cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <img src="{{ asset('images/blog-post-1-715x417.jpg') }}" alt="" width="715" height="417"/>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                            voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                            cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <article class="quote-classic quote-classic_secondary">
                            <div class="quote-classic__body">
                                <svg class="quote-classic__mark" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                     x="0px" y="0px" width="21px" height="15px" viewbox="0 0 21 15" overflow="scroll"
                                     xml:space="preserve" preserveAspectRatio="none">
                      <path
                          d="M9.597,10.412c0,1.306-0.473,2.399-1.418,3.277c-0.944,0.876-2.06,1.316-3.349,1.316                                               c-1.287,0-2.414-0.44-3.382-1.316C0.482,12.811,0,11.758,0,10.535c0-1.226,0.58-2.716,1.739-4.473L5.603,0H9.34L6.956,6.37                                               C8.716,7.145,9.597,8.493,9.597,10.412z M20.987,10.412c0,1.306-0.473,2.399-1.418,3.277c-0.944,0.876-2.06,1.316-3.35,1.316                                               c-1.288,0-2.415-0.44-3.381-1.316c-0.966-0.879-1.45-1.931-1.45-3.154c0-1.226,0.582-2.716,1.74-4.473L16.994,0h3.734l-2.382,6.37                                               C20.106,7.145,20.987,8.493,20.987,10.412z"></path>
                    </svg>
                                <div class="quote-classic__text">
                                    <p>Async/Await can increase the performance and responsiveness of your application,
                                        particularly when you have long-running operations.</p>
                                </div>
                            </div>
                        </article>
                        <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled
                            and demoralized by the charms of pleasure of the moment, so blinded by desire, that they
                            cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to
                            those who fail in their duty through weakness of will, which is the same as saying through
                            shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a
                            free hour, when our power of choice is untrammelled and when nothing prevents our being able
                            to do what we like best, every pleasure is to be welcomed and every pain avoided. But in
                            certain circumstances and owing to the claims of duty or the obligations of business it will
                            frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man
                            therefore always holds in these matters to this principle of selection: he rejects pleasures
                            to secure other greater pleasures, or else he endures pains to avoid worse pains</p>
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
                <x-blog-aside></x-blog-aside>
            </article>
        </div>
    </section>

@endsection
