@extends('layouts.main')
@section('content')
    <!-- Breadcrumbs-->
    <section class="breadcrumbs-custom">
        <div class="breadcrumbs-custom__aside bg-image context-dark" style="background-image: url(images/bg-image-8-1920x1000.jpg);">
            <div class="container">
                <h2 class="breadcrumbs-custom__title">Contact Us</h2>
            </div>
        </div>
        <div class="breadcrumbs-custom__main bg-gray-light">
            <div class="container">
                <ul class="breadcrumbs-custom__path">
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Contact Us</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Contact Form -->
    <section class="section section-md bg-white">
        <div class="container container_bigger">
            <div class="row justify-content-md-center justify-content-xl-between row-2-columns-bordered row-50">
                <div class="col-md-10 col-lg-5">
                    <h3>Get in Touch</h3>
                    <ul class="list-creative">
                        <li>
                            <dl class="list-terms-medium list-terms-medium_secondary">
                                <dt>Address</dt>
                                <dd><a href="#">212 Moore Ave, Brooklyn, NY, United States</a></dd>
                            </dl>
                        </li>
                        <li>
                            <dl class="list-terms-medium">
                                <dt>Phones</dt>
                                <dd>
                                    <ul class="list-comma">
                                        <li><a href="tel:#">+1-800-700-6200 </a></li>
                                        <li><a href="tel:#">+1-800-955-4567</a></li>
                                    </ul>
                                </dd>
                            </dl>
                        </li>
                        <li>
                            <dl class="list-terms-medium list-terms-medium_tertiary">
                                <dt>E-mails</dt>
                                <dd>
                                    <ul class="list-comma">
                                        <li><a href="mailto:#">support@demolink.org</a></li>
                                        <li><a href="mailto:#">office@demolink.org</a></li>
                                    </ul>
                                </dd>
                            </dl>
                        </li>
                    </ul>
                </div>
                <div class="col-md-10 col-lg-7 col-xl-6">
                    <h3 class="text-center">Contact Form</h3>
                    <!-- RD Mailform -->
                    <form class="rd-mailform" data-form-output="form-output-global" data-form-type="contact" method="post" action="bat/rd-mailform.php">
                        <div class="row align-items-md-end row-30">
                            <div class="col-md-6">
                                <div class="form-wrap">
                                    <input class="form-input" id="contact-name" type="text" name="name" data-constraints="Required">
                                    <label class="form-label" for="contact-name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-wrap">
                                    <input class="form-input" id="contact-phone" type="text" name="phone" data-constraints="PhoneNumber">
                                    <label class="form-label" for="contact-phone">Phone</label>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-wrap">
                                    <label class="form-label" for="contact-message">Your Message</label>
                                    <textarea class="form-input" id="contact-message" name="message" data-constraints="Required"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-wrap">
                                    <input class="form-input" id="contact-email" type="email" name="email" data-constraints="Email Required">
                                    <label class="form-label" for="contact-email">E-mail</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button class="button button-block button-primary button-ujarak" type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- RD Google Map-->
    <section class="section">
        <div class="google-map-container" data-center="9870 St Vincent Place, Glasgow, DC 45 Fr 45." data-styles="[{&quot;featureType&quot;:&quot;poi&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;on&quot;}]},{&quot;featureType&quot;:&quot;poi.attraction&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;on&quot;}]},{&quot;featureType&quot;:&quot;poi.business&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;off&quot;}]},{&quot;featureType&quot;:&quot;poi.government&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;off&quot;}]},{&quot;featureType&quot;:&quot;poi.medical&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;off&quot;}]},{&quot;featureType&quot;:&quot;poi.park&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;simplified&quot;}]},{&quot;featureType&quot;:&quot;poi.place_of_worship&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;off&quot;}]},{&quot;featureType&quot;:&quot;poi.school&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;off&quot;}]},{&quot;featureType&quot;:&quot;poi.sports_complex&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;off&quot;}]},{&quot;featureType&quot;:&quot;road.highway&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;on&quot;}]},{&quot;featureType&quot;:&quot;road.arterial&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;on&quot;}]},{&quot;featureType&quot;:&quot;transit&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;off&quot;}]}]">
            <div class="google-map"></div>
            <ul class="google-map-markers">
                <li data-location="9870 St Vincent Place, Glasgow, DC 45 Fr 45." data-description="9870 St Vincent Place, Glasgow" data-icon="images/gmap_marker.png" data-icon-active="images/gmap_marker_active.png"></li>
            </ul>
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
