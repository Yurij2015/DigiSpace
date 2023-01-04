@extends('layouts.main')
@section('title', 'DigiSpace | Contact Us')
@section('content')
    <!-- Breadcrumbs-->
    <section class="breadcrumbs-custom">
        <div class="breadcrumbs-custom__aside bg-image context-dark"
             style="background-image: url({{ asset('images/bg-image-8-1920x1000.jpg') }});">
            <div class="container">
                <h2 class="breadcrumbs-custom__title">Contact Us</h2>
            </div>
        </div>
        <div class="breadcrumbs-custom__main bg-gray-light">
            <div class="container">
                <ul class="breadcrumbs-custom__path">
                    <li><a href="{{ route('home.index') }}">Home</a></li>
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
                    <form class="rd-mailform" data-form-output="form-output-global" data-form-type="contact"
                          method="post" action="bat/rd-mailform.php">
                        <div class="row align-items-md-end row-30">
                            <div class="col-md-6">
                                <div class="form-wrap">
                                    <input class="form-input" id="contact-name" type="text" name="name">
                                    <label class="form-label" for="contact-name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-wrap">
                                    <input class="form-input" id="contact-phone" type="text" name="phone">
                                    <label class="form-label" for="contact-phone">Phone</label>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-wrap">
                                    <label class="form-label" for="contact-message">Your Message</label>
                                    <textarea class="form-input" id="contact-message" name="message"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-wrap">
                                    <input class="form-input" id="contact-email" type="email" name="email">
                                    <label class="form-label" for="contact-email">E-mail</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button class="button button-block button-primary button-ujarak" type="submit">Send
                                    Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- RD Google Map-->
    <section class="section">
        <div class="google-map-container" data-center="9870 St Vincent Place, Glasgow, DC 45 Fr 45."
             data-styles="[{&quot;featureType&quot;:&quot;poi&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;on&quot;}]},{&quot;featureType&quot;:&quot;poi.attraction&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;on&quot;}]},{&quot;featureType&quot;:&quot;poi.business&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;off&quot;}]},{&quot;featureType&quot;:&quot;poi.government&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;off&quot;}]},{&quot;featureType&quot;:&quot;poi.medical&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;off&quot;}]},{&quot;featureType&quot;:&quot;poi.park&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;simplified&quot;}]},{&quot;featureType&quot;:&quot;poi.place_of_worship&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;off&quot;}]},{&quot;featureType&quot;:&quot;poi.school&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;off&quot;}]},{&quot;featureType&quot;:&quot;poi.sports_complex&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;off&quot;}]},{&quot;featureType&quot;:&quot;road.highway&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;on&quot;}]},{&quot;featureType&quot;:&quot;road.arterial&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;on&quot;}]},{&quot;featureType&quot;:&quot;transit&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;off&quot;}]}]">
            <div class="google-map"></div>
            <ul class="google-map-markers">
                <li data-location="9870 St Vincent Place, Glasgow, DC 45 Fr 45."
                    data-description="9870 St Vincent Place, Glasgow" data-icon="images/gmap_marker.png"
                    data-icon-active="images/gmap_marker_active.png"></li>
            </ul>
        </div>
    </section>
@endsection
