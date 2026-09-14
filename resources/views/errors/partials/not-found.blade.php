{{--
    Shared "not found" body. Props: $breadcrumb, $heading, $text, $secondaryHref, $secondaryLabel.
    Used by errors/404 (unmatched routes), errors/page-not-found (missing content) and errors/nothin-found (empty service search).
--}}
<!-- Breadcrumbs-->
<section class="breadcrumbs-custom">
    <div class="breadcrumbs-custom__aside bg-image context-dark"
         style="background-image: url({{ asset('images/bg-about-page.jpeg') }});">
        <div class="container">
            <h2 class="breadcrumbs-custom__title">{{ $breadcrumb }}</h2>
        </div>
    </div>
    <div class="breadcrumbs-custom__main bg-gray-light">
        <div class="container">
            <ul class="breadcrumbs-custom__path">
                <li><a href="{{ route('home.index') }}">{{ __('site.home') }}</a></li>
                <li class="active">{{ $breadcrumb }}</li>
            </ul>
        </div>
    </div>
</section>
<!-- 404-->
<section class="section section-md bg-white text-center">
    <div class="container">
        <h1 class="h3">{{ $heading }}</h1>
        <p class="ls-05">{{ $text }}</p>
        <div class="group-sm group-middle">
            <a class="button button-primary button-ujarak" href="{{ route('home.index') }}">{{ __('site.go_home') }}</a>
            <a class="button button-default button-ujarak" href="{{ $secondaryHref }}">{{ $secondaryLabel }}</a>
        </div>
    </div>
</section>
