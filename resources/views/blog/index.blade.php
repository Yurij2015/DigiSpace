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
    <!-- Page Footer-->
    <footer class="section footer-classic context-dark">
        <div class="footer-classic__main bg-gray-3">
            <div class="container">
                <div class="row row-50 align-items-sm-end justify-content-sm-center justify-content-lg-start">
                    <div class="col-lg-6">
                        <div class="footer-classic__custom-column">
                            <div class="unit flex-sm-row">
                                <div class="unit__left"><span
                                        class="icon icon-md icon-default fl-bigmug-line-headphones32"></span></div>
                                <div class="unit__body"><a class="link link-lg" href="tel:#">1-800-700-6200</a>
                                    <p>Our Support Service is always available 24 hours a day</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10 col-lg-6">
                        <div class="group-md">
                            <h3>Subscribe</h3>
                            <p class="large">Get the latest updates and offers</p>
                        </div>
                        <!-- RD Mailform-->
                        <form class="rd-mailform form_inline form_lg" data-form-output="form-output-global"
                              data-form-type="subscribe" method="post" action="bat/rd-mailform.php">
                            <div class="form-wrap">
                                <input class="form-input" id="subscribe-form-footer-form-email" type="email"
                                       name="email">
                                <label class="form-label" for="subscribe-form-footer-form-email">Your E-mail</label>
                            </div>
                            <div class="form-button">
                                <button class="button button-lg button-primary button-ujarak" type="submit">Subscribe
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row row-50 justify-content-md-center justify-content-lg-start justify-content-xl-between">
                    <div class="col-md-5 col-lg-3">
                        <p class="custom-heading-1 custom-heading-bordered">About us</p>
                        <div class="divider"></div>
                        <p class="ls-05">Our company has been developing high-quality and reliable software for
                            corporate needs since 2008.</p>
                        <ul class="list-inline list-inline-xs">
                            <li><a class="icon icon-xxs icon-circle icon-filled icon-filled_brand fa fa-facebook"
                                   href="#"></a></li>
                            <li><a class="icon icon-xxs icon-circle icon-filled icon-filled_brand fa fa-twitter"
                                   href="#"></a></li>
                            <li><a class="icon icon-xxs icon-circle icon-filled icon-filled_brand fa fa-google-plus"
                                   href="#"></a></li>
                            <li><a class="icon icon-xxs icon-circle icon-filled icon-filled_brand fa fa-instagram"
                                   href="#"></a></li>
                        </ul>
                    </div>
                    <div class="col-md-5 col-lg-4 col-xl-3">
                        <p class="custom-heading-1 custom-heading-bordered">Latest news</p>
                        <div class="divider"></div>
                        <div class="post-small-wrap">
                            <!-- Post small-->
                            <article class="post-small">
                                <div class="post-small__aside"><a class="post-small__media" href="blog-post.html"><img
                                            class="post-small__image" src="{{ asset('images/post-small-1-80x68.jpg') }}"
                                            alt=""
                                            width="80" height="68"/></a></div>
                                <div class="post-small__main">
                                    <p class="post-small__title"><a href="blog-post.html">Benefits of Async/Await in
                                            Programming</a></p>
                                    <time class="post-small__time" datetime="2022">January 12, 2022</time>
                                </div>
                            </article>
                            <!-- Post small-->
                            <article class="post-small">
                                <div class="post-small__aside"><a class="post-small__media" href="blog-post.html"><img
                                            class="post-small__image" src="{{ asset('images/post-small-2-80x68.jpg') }}"
                                            alt=""
                                            width="80" height="68"/></a></div>
                                <div class="post-small__main">
                                    <p class="post-small__title"><a href="blog-post.html">Key Considerations and
                                            Warnings of iPaaS</a></p>
                                    <time class="post-small__time" datetime="2022">January 12, 2022</time>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="col-md-10 col-lg-5 col-xl-4">
                        <p class="custom-heading-1 custom-heading-bordered">Useful Links</p>
                        <div class="divider"></div>
                        <div class="row row-5">
                            <div class="col-sm-6">
                                <ul class="list-marked list-marked_primary">
                                    <li><a href="#">DB Management</a></li>
                                    <li><a href="#">iOS/MacOs Apps</a></li>
                                    <li><a href="#">Android Apps</a></li>
                                    <li><a href="#">Windows Apps</a></li>
                                    <li><a href="#">UX Design</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul class="list-marked list-marked_primary">
                                    <li><a href="#">Tutorials</a></li>
                                    <li><a href="#">Product Support</a></li>
                                    <li><a href="contact-us.html">Contact Us</a></li>
                                    <li><a href="blog.html">Blog</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-default__aside bg-gray-5">
            <div class="container">
                <div class="footer-default__aside-inner">
                    <!-- Rights-->
                    <p class="rights"><span>&copy;&nbsp;</span><span
                            class="copyright-year"></span><span>&nbsp;</span><span>Techsoft</span><span>.&nbsp;</span><a
                            href="privacy-policy.html">Privacy Policy</a></p>
                    <ul class="list-separated list-inline">
                        <li><a href="faq.html">FAQ</a></li>
                        <li><a href="#">Support</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
@endsection
