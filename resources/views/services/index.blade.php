@extends('layouts.main')
@section('title', 'DigiSpace | Services')
@section('content')
    <!-- Get a Domain Name-->
    <!-- Breadcrumbs-->
    <section class="breadcrumbs-custom">
        <div class="breadcrumbs-custom__aside bg-image context-dark"
             style="background-image: url({{ asset("images/bg-image-12-1920x238.jpg") }});">
            <div class="container">
                <h2 class="breadcrumbs-custom__title">Services</h2>
            </div>
        </div>
        <div class="breadcrumbs-custom__main bg-gray-light">
            <div class="container">
                <ul class="breadcrumbs-custom__path">
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Services</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="section section-lg text-center">
        <div class="container">
            <div class="pricing-table pricing-table-creative">
                <!-- Pricing table item-->
                <article class="pricing-table__item pricing-table-creative__item">
                    <div class="pricing-table__item-inner">
                        <p class="pricing-table__item-title">Basic</p>
                        <div class="pricing-table__item-price">
                            <p class="pricing-table__item-price-value"><span class="small">$</span><span>399.99</span>
                            </p>
                            <p class="pricing-table__item-price-details">starting at</p>
                        </div>
                        <div class="pricing-table__item-control">
                            <div class="button-wrap"><a class="button btn-primary-outline button-ujarak" href="#">Order
                                    now</a></div>
                        </div>
                        <ul class="pricing-table__item-features">
                            <li><span class="text-marked">Concept development</span></li>
                            <li><span class="text-marked">UI design</span></li>
                            <li><span>Configuration management</span></li>
                            <li><span>Software quality assurance</span></li>
                        </ul>
                    </div>
                </article>
                <!-- Pricing table item-->
                <article class="pricing-table__item pricing-table-creative__item pricing-table-creative__item_prefered">
                    <div class="pricing-table__item-inner">
                        <p class="pricing-table__item-title">Optimal</p>
                        <div class="pricing-table__item-price">
                            <p class="pricing-table__item-price-value"><span class="small">$</span><span>599.99</span>
                            </p>
                            <p class="pricing-table__item-price-details">starting at</p>
                        </div>
                        <div class="pricing-table__item-control">
                            <div class="button-wrap"><a class="button btn-white-outline button-ujarak" href="#">Order
                                    now</a></div>
                        </div>
                        <ul class="pricing-table__item-features">
                            <li><span class="text-marked">Concept development</span></li>
                            <li><span class="text-marked">UI design</span></li>
                            <li><span class="text-marked">Configuration management</span></li>
                            <li><span class="text-accent">Software quality assurance</span></li>
                        </ul>
                    </div>
                </article>
                <!-- Pricing table item-->
                <article class="pricing-table__item pricing-table-creative__item">
                    <div class="pricing-table__item-inner">
                        <p class="pricing-table__item-title">Ultimate</p>
                        <div class="pricing-table__item-price">
                            <p class="pricing-table__item-price-value"><span class="small">$</span><span>999.99</span>
                            </p>
                            <p class="pricing-table__item-price-details">starting at</p>
                        </div>
                        <div class="pricing-table__item-control">
                            <div class="button-wrap"><a class="button btn-primary-outline button-ujarak" href="#">Order
                                    now</a></div>
                        </div>
                        <ul class="pricing-table__item-features">
                            <li><span class="text-marked">Concept development</span></li>
                            <li><span class="text-marked">UI design</span></li>
                            <li><span class="text-marked">Configuration management</span></li>
                            <li><span class="text-marked">Software quality assurance</span></li>
                        </ul>
                    </div>
                </article>
            </div>

        </div>
    </section>
    <section class="section section-sm bg-white text-center">
        <div class="container">
            <h2>Why Choose Us</h2>
            <div class="row row-30 wow fadeIn">
                <div class="col-md-6 col-lg-4">
                    <!-- Box Alice-->
                    <article class="box-alice">
                        <div class="box-alice__inner">
                            <div class="box-alice__aside">
                                <div class="box-alice__icon-outer">
                                    <div class="icon-figure">
                                        <div class="box-triangle">
                                            <svg x="0px" y="0px" width="80px" height="80px" viewBox="0 0 100 100"
                                                 style="fill: #f7f7f7;">
                                                <path
                                                    d="M20,93.301c-11,0-15.5-7.794-10-17.321l30-51.962c5.5-9.526,14.5-9.526,20,0l30,51.962 c5.5,9.526,1,17.321-10,17.321H20z"></path>
                                            </svg>
                                        </div>
                                        <span class="box-alice__icon linearicons-cog"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="box-alice__main">
                                <h5 class="box-alice__title">High Quality Hardware</h5>
                                <p>We use top-notch hardware to develop the most efficient apps for our customers.</p>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-lg-4">
                    <!-- Box Alice-->
                    <article class="box-alice">
                        <div class="box-alice__inner">
                            <div class="box-alice__aside">
                                <div class="box-alice__icon-outer">
                                    <div class="icon-figure">
                                        <div class="box-triangle">
                                            <svg x="0px" y="0px" width="80px" height="80px" viewBox="0 0 100 100"
                                                 style="fill: #f7f7f7;">
                                                <path
                                                    d="M20,93.301c-11,0-15.5-7.794-10-17.321l30-51.962c5.5-9.526,14.5-9.526,20,0l30,51.962 c5.5,9.526,1,17.321-10,17.321H20z"></path>
                                            </svg>
                                        </div>
                                        <span class="box-alice__icon linearicons-headset"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="box-alice__main">
                                <h5 class="box-alice__title">Dedicated 24\7 Support</h5>
                                <p>You can rely on our 24/7 tech support that will gladly solve any app issue you may
                                    have.</p>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-lg-4">
                    <!-- Box Alice-->
                    <article class="box-alice">
                        <div class="box-alice__inner">
                            <div class="box-alice__aside">
                                <div class="box-alice__icon-outer">
                                    <div class="icon-figure">
                                        <div class="box-triangle">
                                            <svg x="0px" y="0px" width="80px" height="80px" viewBox="0 0 100 100"
                                                 style="fill: #f7f7f7;">
                                                <path
                                                    d="M20,93.301c-11,0-15.5-7.794-10-17.321l30-51.962c5.5-9.526,14.5-9.526,20,0l30,51.962 c5.5,9.526,1,17.321-10,17.321H20z"></path>
                                            </svg>
                                        </div>
                                        <span class="box-alice__icon linearicons-wallet"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="box-alice__main">
                                <h5 class="box-alice__title">30-Day Money-back Guarantee</h5>
                                <p>If you are not satisfied with our apps, we will return your money in the first 30
                                    days.</p>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-lg-4">
                    <!-- Box Alice-->
                    <article class="box-alice">
                        <div class="box-alice__inner">
                            <div class="box-alice__aside">
                                <div class="box-alice__icon-outer">
                                    <div class="icon-figure">
                                        <div class="box-triangle">
                                            <svg x="0px" y="0px" width="80px" height="80px" viewBox="0 0 100 100"
                                                 style="fill: #f7f7f7;">
                                                <path
                                                    d="M20,93.301c-11,0-15.5-7.794-10-17.321l30-51.962c5.5-9.526,14.5-9.526,20,0l30,51.962 c5.5,9.526,1,17.321-10,17.321H20z"></path>
                                            </svg>
                                        </div>
                                        <span class="box-alice__icon linearicons-rocket"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="box-alice__main">
                                <h5 class="box-alice__title">Agile and Fast Working Style</h5>
                                <p>This type of approach to our work helps our specialists to quickly develop better
                                    apps.</p>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-lg-4">
                    <!-- Box Alice-->
                    <article class="box-alice">
                        <div class="box-alice__inner">
                            <div class="box-alice__aside">
                                <div class="box-alice__icon-outer">
                                    <div class="icon-figure">
                                        <div class="box-triangle">
                                            <svg x="0px" y="0px" width="80px" height="80px" viewBox="0 0 100 100"
                                                 style="fill: #f7f7f7;">
                                                <path
                                                    d="M20,93.301c-11,0-15.5-7.794-10-17.321l30-51.962c5.5-9.526,14.5-9.526,20,0l30,51.962 c5.5,9.526,1,17.321-10,17.321H20z"></path>
                                            </svg>
                                        </div>
                                        <span class="box-alice__icon linearicons-phone"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="box-alice__main">
                                <h5 class="box-alice__title">Some Apps are Free</h5>
                                <p>We also develop free apps that can be downloaded online without any payments.</p>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-lg-4">
                    <!-- Box Alice-->
                    <article class="box-alice">
                        <div class="box-alice__inner">
                            <div class="box-alice__aside">
                                <div class="box-alice__icon-outer">
                                    <div class="icon-figure">
                                        <div class="box-triangle">
                                            <svg x="0px" y="0px" width="80px" height="80px" viewBox="0 0 100 100"
                                                 style="fill: #f7f7f7;">
                                                <path
                                                    d="M20,93.301c-11,0-15.5-7.794-10-17.321l30-51.962c5.5-9.526,14.5-9.526,20,0l30,51.962 c5.5,9.526,1,17.321-10,17.321H20z"></path>
                                            </svg>
                                        </div>
                                        <span class="box-alice__icon linearicons-thumbs-up"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="box-alice__main">
                                <h5 class="box-alice__title">High Level of Usability</h5>
                                <p>All our products have high usability allowing users to easily operate the apps.</p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
    <!-- Your Questions-->
    <section class="section section-md bg-gray-light text-center">
        <div class="container">
            <h2>Frequently Asked Questions</h2>
            <!-- Bootstrap collapse-->
            <div class="card-group card-group-custom card-group-corporate" id="accordion1" role="tablist"
                 aria-multiselectable="true">
                <div class="row row-30">
                    <div class="col-md-6">
                        <!-- Bootstrap card-->
                        <div class="card card-custom card-corporate">
                            <div class="card-heading" id="accordion1Heading1" role="tab">
                                <div class="card-title"><a role="button" data-bs-toggle="collapse"
                                                           data-bs-parent="#accordion1" href="#accordion1Collapse1"
                                                           aria-controls="accordion1Collapse1" aria-expanded="true">Can
                                        I track my order?
                                        <div class="card-arrow"></div>
                                    </a>
                                </div>
                            </div>
                            <div class="card-collapse collapse show" id="accordion1Collapse1" role="tabpanel"
                                 aria-labelledby="accordion1Heading1">
                                <div class="card-body">
                                    <p>Yes, you can! After placing your order you will receive an order confirmation via
                                        email. Each order starts production 24 hours after your order is placed. Within
                                        72 hours of you placing your order, you will receive an expected delivery date.
                                        When the order ships, you will receive another email with the tracking number
                                        and a link.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Bootstrap card-->
                        <div class="card card-custom card-corporate">
                            <div class="card-heading" id="accordion1Heading2" role="tab">
                                <div class="card-title"><a class="collapsed" role="button" data-bs-toggle="collapse"
                                                           data-bs-parent="#accordion1" href="#accordion1Collapse2"
                                                           aria-controls="accordion1Collapse2">How can I change
                                        something in my order?
                                        <div class="card-arrow"></div>
                                    </a>
                                </div>
                            </div>
                            <div class="card-collapse collapse" id="accordion1Collapse2" role="tabpanel"
                                 aria-labelledby="accordion1Heading2">
                                <div class="card-body">
                                    <p>If you need to change something in your order, please contact us immediately. We
                                        usually process orders within 30 minutes, and once we have processed your order,
                                        we will be unable to make any changes.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Bootstrap card-->
                        <div class="card card-custom card-corporate">
                            <div class="card-heading" id="accordion1Heading3" role="tab">
                                <div class="card-title"><a class="collapsed" role="button" data-bs-toggle="collapse"
                                                           data-bs-parent="#accordion1" href="#accordion1Collapse3"
                                                           aria-controls="accordion1Collapse3">How can I pay for my
                                        order?
                                        <div class="card-arrow"></div>
                                    </a>
                                </div>
                            </div>
                            <div class="card-collapse collapse" id="accordion1Collapse3" role="tabpanel"
                                 aria-labelledby="accordion1Heading3">
                                <div class="card-body">
                                    <p>We accept Visa, MasterCard, and American Express credit and debit cards for your
                                        convenience.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Bootstrap card-->
                        <div class="card card-custom card-corporate">
                            <div class="card-heading" id="accordion1Heading4" role="tab">
                                <div class="card-title"><a class="collapsed" role="button" data-bs-toggle="collapse"
                                                           data-bs-parent="#accordion1" href="#accordion1Collapse4"
                                                           aria-controls="accordion1Collapse4">How long will my order be
                                        delivered?
                                        <div class="card-arrow"></div>
                                    </a>
                                </div>
                            </div>
                            <div class="card-collapse collapse" id="accordion1Collapse4" role="tabpanel"
                                 aria-labelledby="accordion1Heading4">
                                <div class="card-body">
                                    <p>Delivery times will depend on your location. Once payment is confirmed your order
                                        will be packaged. Delivery can be expected within a day.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Bootstrap card-->
                        <div class="card card-custom card-corporate">
                            <div class="card-heading" id="accordion1Heading5" role="tab">
                                <div class="card-title"><a class="collapsed" role="button" data-bs-toggle="collapse"
                                                           data-bs-parent="#accordion1" href="#accordion1Collapse5"
                                                           aria-controls="accordion1Collapse5">Can I return an item?
                                        <div class="card-arrow"></div>
                                    </a>
                                </div>
                            </div>
                            <div class="card-collapse collapse" id="accordion1Collapse5" role="tabpanel"
                                 aria-labelledby="accordion1Heading5">
                                <div class="card-body">
                                    <p>Please contact our administrators for more information on returning products
                                        purchased on our website.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Bootstrap card-->
                        <div class="card card-custom card-corporate">
                            <div class="card-heading" id="accordion1Heading6" role="tab">
                                <div class="card-title"><a class="collapsed" role="button" data-bs-toggle="collapse"
                                                           data-bs-parent="#accordion1" href="#accordion1Collapse6"
                                                           aria-controls="accordion1Collapse6">What is a
                                        unique/non-unique purchase?
                                        <div class="card-arrow"></div>
                                    </a>
                                </div>
                            </div>
                            <div class="card-collapse collapse" id="accordion1Collapse6" role="tabpanel"
                                 aria-labelledby="accordion1Heading6">
                                <div class="card-body">
                                    <p>Non-exclusive purchase means that other people can buy the template you have
                                        chosen some time later. Exclusive or unique purchase guarantees that you are the
                                        last person to buy this template. After an exclusive purchase occurs the
                                        template is being permanently removed from the sales directory and will never be
                                        available to other customers again. Only you and people who bought the template
                                        before you will own it.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
