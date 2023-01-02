@extends('layouts.main')
@section('content')
    <!-- Breadcrumbs-->
    <section class="breadcrumbs-custom">
        <div class="breadcrumbs-custom__aside bg-image context-dark"
             style="background-image: url(images/bg-image-14-1920x330.jpg);">
            <div class="container">
                <h2 class="breadcrumbs-custom__title">Promos</h2>
            </div>
        </div>
        <div class="breadcrumbs-custom__main bg-gray-light">
            <div class="container">
                <ul class="breadcrumbs-custom__path">
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Promos</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Promos-->
    <section class="section section-md bg-white text-center">
        <div class="container">
            <div class="row row-30">
                <div class="col-md-6 col-lg-4">
                    <!-- Promo Classic-->
                    <article class="promo-classic">
                        <div class="promo-classic__inner">
                            <div class="promo-classic__icon-wrap">
                                <div class="promo-classic__icon"><span class="fl-bigmug-line-file69"></span></div>
                            </div>
                            <div class="promo-classic__main">
                                <div class="promo-classic__label">
                                    <svg class="promo-classic__label-svg" x="0px" y="0px" width="51px" height="23px"
                                         viewbox="0 0 51 23" preserveAspectRatio="xMaxYMin">
                                        <polygon
                                            points="0.012,0.006 0.012,22.995 43.991,22.995 43.991,23 50.988,11.5 43.991,0 43.991,0.006 "></polygon>
                                    </svg>
                                    <span>-25%</span>
                                </div>
                                <h4 class="promo-classic__title">Windows Applications</h4>
                                <div class="promo-classic__divider"></div>
                                <div class="promo-classic__price"><span
                                        class="promo-classic__price-currency">$</span><span
                                        class="promo-classic__price-value">126</span>
                                    <div class="promo-classic__price-aside"><span class="top">99</span><span
                                            class="bottom">year</span></div>
                                </div>
                                <p class="promo-classic__price-old">Old Price $200.00</p>
                                <div class="promo-classic__control"><a class="button button-primary button-ujarak"
                                                                       href="#">Order now</a></div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-lg-4">
                    <!-- Promo Classic-->
                    <article class="promo-classic">
                        <div class="promo-classic__inner">
                            <div class="promo-classic__icon-wrap">
                                <div class="promo-classic__icon"><span class="fl-bigmug-line-hot67"></span></div>
                            </div>
                            <div class="promo-classic__main">
                                <div class="promo-classic__label promo-classic__label-sm">
                                    <svg class="promo-classic__label-svg" x="0px" y="0px" width="51px" height="23px"
                                         viewbox="0 0 51 23" preserveAspectRatio="xMaxYMin">
                                        <polygon
                                            points="0.012,0.006 0.012,22.995 43.991,22.995 43.991,23 50.988,11.5 43.991,0 43.991,0.006 "></polygon>
                                    </svg>
                                    <span>Free Trial</span>
                                </div>
                                <h4 class="promo-classic__title">iOS & Android Apps</h4>
                                <div class="promo-classic__divider"></div>
                                <div class="promo-classic__price"><span
                                        class="promo-classic__price-currency">$</span><span
                                        class="promo-classic__price-value">0</span>
                                    <div class="promo-classic__price-aside"><span class="top">99</span><span
                                            class="bottom">mon</span></div>
                                </div>
                                <p class="promo-classic__price-old">Old Price $100.00</p>
                                <div class="promo-classic__control"><a class="button button-primary button-ujarak"
                                                                       href="#">Order now</a></div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-lg-4">
                    <!-- Promo Classic-->
                    <article class="promo-classic">
                        <div class="promo-classic__inner">
                            <div class="promo-classic__icon-wrap">
                                <div class="promo-classic__icon promo-classic__icon-sm"><span
                                        class="fl-bigmug-line-email64"></span></div>
                            </div>
                            <div class="promo-classic__main">
                                <div class="promo-classic__label">
                                    <svg class="promo-classic__label-svg" x="0px" y="0px" width="51px" height="23px"
                                         viewbox="0 0 51 23" preserveAspectRatio="xMaxYMin">
                                        <polygon
                                            points="0.012,0.006 0.012,22.995 43.991,22.995 43.991,23 50.988,11.5 43.991,0 43.991,0.006 "></polygon>
                                    </svg>
                                    <span>-50%</span>
                                </div>
                                <h4 class="promo-classic__title">QA & Testing Services</h4>
                                <div class="promo-classic__divider"></div>
                                <div class="promo-classic__price"><span
                                        class="promo-classic__price-currency">$</span><span
                                        class="promo-classic__price-value">45</span>
                                    <div class="promo-classic__price-aside"><span class="top">99</span><span
                                            class="bottom">mon</span></div>
                                </div>
                                <p class="promo-classic__price-old">Old Price $150.00</p>
                                <div class="promo-classic__control"><a class="button button-primary button-ujarak"
                                                                       href="#">Order now</a></div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
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
                                            class="post-small__image" src="images/post-small-1-80x68.jpg" alt=""
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
                                            class="post-small__image" src="images/post-small-2-80x68.jpg" alt=""
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

