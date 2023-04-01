@extends('layouts.main')
@section('title', "DigiSpace | Page - $slug")
@section('content')
    <!-- Breadcrumbs-->
    <section class="breadcrumbs-custom">
        <div class="breadcrumbs-custom__aside bg-image context-dark"
             style="background-image: url({{ asset('images/bg-image-15-1920x860.jpg')}});">
            <div class="container">
                <h2 class="breadcrumbs-custom__title">Page - {{ $slug }}</h2>
            </div>
        </div>
        <div class="breadcrumbs-custom__main bg-gray-light">
            <div class="container">
                <ul class="breadcrumbs-custom__path">
                    <li><a href="{{ route('home.index')}}">Home</a></li>
                    <li>Pages</li>
                    <li class="active">{{ $slug }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Page title-->
    <section class="section section-md bg-white text-center">
        <div class="container">
            <div class="row row-50 justify-content-md-center">
                <div class="col-md-9 col-lg-8 col-xl-6">
                    <h3>Grid system {{ $slug }}</h3>
                    <p class="big">A responsive fluid grid system that appropriately scales up to 12 columns with
                        gorgeous full-width and boxed options.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-md bg-white">
        <div class="container grid-system-bordered grid-demonstration">
            <h4 class="text-center">Boxed Grid System</h4>
            <div class="row">
                <div class="col-12">
                    <h5>1/1</h5>
                    <p>Welcome to our wonderful world. We sincerely hope that each and every user entering our website
                        will find exactly what he/she is looking for. With advanced features of activating account and
                        new login widgets, you will definitely have a great experience of using our web page. It will
                        tell you lots of interesting things about our company, its products and services, highly
                        professional staff and happy customers. Our site design and navigation has been thoroughly
                        thought out. The layout is aesthetically appealing, contains concise texts in order not to take
                        your precious time. Text styling allows scanning the pages quickly. Site navigation is extremely
                        intuitive and user-friendly. You will always know where you are now and will be able to skip
                        from one page to another with a single mouse click. We use only trusted, verified content, so
                        you can believe every word we are saying. We are always happy to greet the new visitors on our
                        site. Our blog and social media accounts are available to encourage communication and connection
                        between clients and personnel and tell you more about us in the informal environments where we
                        can have a dialogue instead of just a narrative like that.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
