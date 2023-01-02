@extends('layouts.main')

@section('content')
    <!-- Breadcrumbs-->
    <section class="breadcrumbs-custom">
        <div class="breadcrumbs-custom__aside bg-image context-dark" style="background-image: url(images/bg-image-11-1920x550.jpg);">
            <div class="container">
                <h2 class="breadcrumbs-custom__title">About</h2>
            </div>
        </div>
        <div class="breadcrumbs-custom__main bg-gray-light">
            <div class="container">
                <ul class="breadcrumbs-custom__path">
                    <li><a href="index.html">Home</a></li>
                    <li class="active">About</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- General Info-->
    <section class="section section-lg bg-white">
        <div class="container">
            <div class="row row-50 justify-content-md-center justify-content-lg-start">
                <div class="col-md-10 col-lg-6">
                    <div class="image-custom-1"><img src="images/about-1-602x359.jpg" alt="" width="602" height="359"/>
                    </div>
                </div>
                <div class="col-md-10 col-lg-6">
                    <div class="box-inset-1">
                        <!-- Bootstrap tabs -->
                        <div class="tabs-custom tabs-horizontal tabs-corporate tabs-corporate_left" id="tabs-about">
                            <!-- Nav tabs-->
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a class="nav-link active" href="#tabs-about-1" data-bs-toggle="tab">What we do</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tabs-about-2" data-bs-toggle="tab">Our Mission</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tabs-about-3" data-bs-toggle="tab">Our Goal </a></li>
                            </ul>
                            <!-- Tab panes-->
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tabs-about-1">
                                    <h4>Developing High-quality Apps</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                </div>
                                <div class="tab-pane fade" id="tabs-about-2">
                                    <h4>Providing Reliable Software</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                </div>
                                <div class="tab-pane fade" id="tabs-about-3">
                                    <h4>Supporting Our Clients</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Team-->
    <section class="section section-lg bg-gray-light text-center">
        <div class="container">
            <h2>Meet Our Team</h2>
            <div class="row row-50">
                <div class="col-md-6 col-lg-4">
                    <!-- Card Creative-->
                    <article class="card-creative">
                        <div class="card-creative__inner">
                            <figure class="card-creative__media"><img src="images/team-1-230x211.jpg" alt="" width="230" height="211"/>
                            </figure>
                            <p class="card-creative__title">Ann Peterson</p>
                            <p class="card-creative__subtitle">UI Designer</p>
                            <div class="card-creative__divider"></div>
                            <div class="card-creative__aside">
                                <ul class="list-inline list-inline-md">
                                    <li><a class="icon icon-xs icon-darker icon-style-brand fa fa-facebook" href="#"></a></li>
                                    <li><a class="icon icon-xs icon-darker icon-style-brand fa fa-twitter" href="#"></a></li>
                                    <li><a class="icon icon-xs icon-darker icon-style-brand fa fa-google-plus" href="#"></a></li>
                                    <li><a class="icon icon-xs icon-darker icon-style-brand fa fa-pinterest-p" href="#"></a></li>
                                </ul>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-lg-4">
                    <!-- Card Creative-->
                    <article class="card-creative">
                        <div class="card-creative__inner">
                            <figure class="card-creative__media"><img src="images/team-2-230x211.jpg" alt="" width="230" height="211"/>
                            </figure>
                            <p class="card-creative__title">Sam Williams</p>
                            <p class="card-creative__subtitle">Lead Developer</p>
                            <div class="card-creative__divider"></div>
                            <div class="card-creative__aside">
                                <ul class="list-inline list-inline-md">
                                    <li><a class="icon icon-xs icon-darker icon-style-brand fa fa-facebook" href="#"></a></li>
                                    <li><a class="icon icon-xs icon-darker icon-style-brand fa fa-twitter" href="#"></a></li>
                                    <li><a class="icon icon-xs icon-darker icon-style-brand fa fa-google-plus" href="#"></a></li>
                                    <li><a class="icon icon-xs icon-darker icon-style-brand fa fa-pinterest-p" href="#"></a></li>
                                </ul>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-lg-4">
                    <!-- Card Creative-->
                    <article class="card-creative">
                        <div class="card-creative__inner">
                            <figure class="card-creative__media"><img src="images/team-3-230x211.jpg" alt="" width="230" height="211"/>
                            </figure>
                            <p class="card-creative__title">Emily Smith</p>
                            <p class="card-creative__subtitle">Marketing Manager</p>
                            <div class="card-creative__divider"></div>
                            <div class="card-creative__aside">
                                <ul class="list-inline list-inline-md">
                                    <li><a class="icon icon-xs icon-darker icon-style-brand fa fa-facebook" href="#"></a></li>
                                    <li><a class="icon icon-xs icon-darker icon-style-brand fa fa-twitter" href="#"></a></li>
                                    <li><a class="icon icon-xs icon-darker icon-style-brand fa fa-google-plus" href="#"></a></li>
                                    <li><a class="icon icon-xs icon-darker icon-style-brand fa fa-pinterest-p" href="#"></a></li>
                                </ul>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
    <!-- Facts-->
    <section class="section parallax-container bg-gray-darker" data-parallax-img="images/bg-3-1920x480.jpg">
        <div class="parallax-content">
            <div class="section-lg text-center">
                <div class="container">
                    <h2>Some Facts About Us</h2>
                    <p class="text-style-1">More than 1000 apps developed</p>
                    <div class="row row-30 offset-top-1">
                        <div class="col-sm-6 col-md-3">
                            <!--Counter-->
                            <article class="box-counter">
                                <div class="box-counter__main">
                                    <div class="counter-prefix">1.</div>
                                    <div class="counter">6</div>
                                    <div class="small">k</div>
                                </div>
                                <div class="box-counter__divider"></div>
                                <p class="box-counter__title">Apps Installed</p>
                            </article>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <!--Counter-->
                            <article class="box-counter">
                                <div class="box-counter__main">
                                    <div class="counter">27</div>
                                </div>
                                <div class="box-counter__divider"></div>
                                <p class="box-counter__title">Awards Won</p>
                            </article>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <!--Counter-->
                            <article class="box-counter">
                                <div class="box-counter__main">
                                    <div class="counter">45</div>
                                    <div class="small">+</div>
                                </div>
                                <div class="box-counter__divider"></div>
                                <p class="box-counter__title">Staff Members</p>
                            </article>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <!--Counter-->
                            <article class="box-counter">
                                <div class="box-counter__main">
                                    <div class="counter">99</div>
                                    <div class="small small_top">%</div>
                                </div>
                                <div class="box-counter__divider"></div>
                                <p class="box-counter__title">Satisfied Customers</p>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Our Clients-->
    <section class="section section-md bg-gray-light text-center">
        <svg x="0px" y="0px" width="0" height="0">
            <defs>
                <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" stop-color="#00abfa"></stop>
                    <stop offset="100%" stop-color="#00caad"></stop>
                </linearGradient>
            </defs>
        </svg>
        <div class="container">
            <h2>Our Clients</h2>
            <!-- Owl Carousel-->
            <div class="owl-outer-navigation-wrap owl-carousel_nav-modern wow fadeIn">
                <div class="owl-carousel quote-creative-carousel review-carousel" data-items="1" data-lg-items="2" data-stage-padding="0" data-margin="30" data-owl="{&quot;dots&quot;:true,&quot;nav&quot;:true,&quot;loop&quot;:true,&quot;autoplayTimeout&quot;:3500,&quot;navContainer&quot;:&quot;#owl-carousel-nav&quot;,&quot;dotsEach&quot;:1}">
                    <div class="item">
                        <!-- Quote Creative-->
                        <article class="quote-creative">
                            <div class="quote-creative__header">
                                <div class="quote-creative__media"><img src="images/user-2-112x99.jpg" alt="" width="112" height="99"/>
                                </div>
                                <div class="quote-creative__info">
                                    <p class="quote-creative__title">Michael Johnson</p>
                                    <p class="quote-creative__subtitle">Regular Client</p>
                                </div>
                            </div>
                            <div class="quote-creative__main">
                                <div class="quote-creative__mark">
                                    <svg x="0px" y="0px" width="39px" height="21px" viewbox="0 0 39 21">
                                        <g fill="url(#grad1)">
                                            <polyline points="8.955,21 0,14.031 0.002,0.001 15.984,0.001 15.984,13.984 8.969,14.016 "></polyline>
                                            <polyline points="31.97,20.999 23.016,14.031 23.018,0.001 39,0.001 39,13.984 31.984,14.015 "></polyline>
                                        </g>
                                    </svg>
                                </div>
                                <div class="quote-creative__main-text">
                                    <p>TechSoft offers a high caliber of resources skilled in Microsoft Azure .NET, mobile and Quality Assurance. They became our true business partners over the past three years of our cooperation.</p>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="item">
                        <!-- Quote Creative-->
                        <article class="quote-creative">
                            <div class="quote-creative__header">
                                <div class="quote-creative__media"><img src="images/user-1-112x99.jpg" alt="" width="112" height="99"/>
                                </div>
                                <div class="quote-creative__info">
                                    <p class="quote-creative__title">Rachel Adams</p>
                                    <p class="quote-creative__subtitle">Regular Client</p>
                                </div>
                            </div>
                            <div class="quote-creative__main">
                                <div class="quote-creative__mark">
                                    <svg x="0px" y="0px" width="39px" height="21px" viewbox="0 0 39 21">
                                        <g fill="url(#grad1)">
                                            <polyline points="8.955,21 0,14.031 0.002,0.001 15.984,0.001 15.984,13.984 8.969,14.016 "></polyline>
                                            <polyline points="31.97,20.999 23.016,14.031 23.018,0.001 39,0.001 39,13.984 31.984,14.015 "></polyline>
                                        </g>
                                    </svg>
                                </div>
                                <div class="quote-creative__main-text">
                                    <p>TechSoft is a highly skilled and uniquely capable firm with multitudes of talent on-board. We have collaborated on a number of diverse projects that have been a great success.</p>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="owl-outer-navigation" id="owl-carousel-nav"></div>
            </div>
        </div>
    </section>
    <!-- Partners-->
    <section class="section section-md bg-white text-center">
        <div class="container">
            <div class="row row-30 align-items-sm-center">
                <div class="col-sm-6 col-md-3 wow fadeIn"><a class="link-image" href="#"><img src="images/brand-1-126x68.png" alt="" width="126" height="68"/></a></div>
                <div class="col-sm-6 col-md-3 wow fadeIn"><a class="link-image" href="#"><img src="images/brand-2-126x100.png" alt="" width="126" height="100"/></a></div>
                <div class="col-sm-6 col-md-3 wow fadeIn"><a class="link-image" href="#"><img src="images/brand-3-134x83.png" alt="" width="134" height="83"/></a></div>
                <div class="col-sm-6 col-md-3 wow fadeIn"><a class="link-image" href="#"><img src="images/brand-4-138x55.png" alt="" width="138" height="55"/></a></div>
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
                                <div class="unit__left"><span class="icon icon-md icon-default fl-bigmug-line-headphones32"></span></div>
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
                        <form class="rd-mailform form_inline form_lg" data-form-output="form-output-global" data-form-type="subscribe" method="post" action="bat/rd-mailform.php">
                            <div class="form-wrap">
                                <input class="form-input" id="subscribe-form-footer-form-email" type="email" name="email" data-constraints="Email Required">
                                <label class="form-label" for="subscribe-form-footer-form-email">Your E-mail</label>
                            </div>
                            <div class="form-button">
                                <button class="button button-lg button-primary button-ujarak" type="submit">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row row-50 justify-content-md-center justify-content-lg-start justify-content-xl-between">
                    <div class="col-md-5 col-lg-3">
                        <p class="custom-heading-1 custom-heading-bordered">About us</p>
                        <div class="divider"></div>
                        <p class="ls-05">Our company has been developing high-quality and reliable software for corporate needs since 2008.</p>
                        <ul class="list-inline list-inline-xs">
                            <li><a class="icon icon-xxs icon-circle icon-filled icon-filled_brand fa fa-facebook" href="#"></a></li>
                            <li><a class="icon icon-xxs icon-circle icon-filled icon-filled_brand fa fa-twitter" href="#"></a></li>
                            <li><a class="icon icon-xxs icon-circle icon-filled icon-filled_brand fa fa-google-plus" href="#"></a></li>
                            <li><a class="icon icon-xxs icon-circle icon-filled icon-filled_brand fa fa-instagram" href="#"></a></li>
                        </ul>
                    </div>
                    <div class="col-md-5 col-lg-4 col-xl-3">
                        <p class="custom-heading-1 custom-heading-bordered">Latest news</p>
                        <div class="divider"></div>
                        <div class="post-small-wrap">
                            <!-- Post small-->
                            <article class="post-small">
                                <div class="post-small__aside"><a class="post-small__media" href="blog-post.html"><img class="post-small__image" src="images/post-small-1-80x68.jpg" alt="" width="80" height="68"/></a></div>
                                <div class="post-small__main">
                                    <p class="post-small__title"><a href="blog-post.html">Benefits of Async/Await in Programming</a></p>
                                    <time class="post-small__time" datetime="2022">January 12, 2022</time>
                                </div>
                            </article>
                            <!-- Post small-->
                            <article class="post-small">
                                <div class="post-small__aside"><a class="post-small__media" href="blog-post.html"><img class="post-small__image" src="images/post-small-2-80x68.jpg" alt="" width="80" height="68"/></a></div>
                                <div class="post-small__main">
                                    <p class="post-small__title"><a href="blog-post.html">Key Considerations and Warnings of iPaaS</a></p>
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
                    <p class="rights"><span>&copy;&nbsp;</span><span class="copyright-year"></span><span>&nbsp;</span><span>Techsoft</span><span>.&nbsp;</span><a href="privacy-policy.html">Privacy Policy</a></p>
                    <ul class="list-separated list-inline">
                        <li><a href="faq.html">FAQ</a></li>
                        <li><a href="#">Support</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
@endsection
