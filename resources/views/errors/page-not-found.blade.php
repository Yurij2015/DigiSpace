@extends('layouts.main')
@section('title', __('site.not_found_title'))
@section('content')
    @include('errors.partials.not-found', [
        'breadcrumb' => __('site.not_found_breadcrumb'),
        'heading' => __('site.not_found_heading'),
        'text' => __('site.not_found_text'),
        'secondaryHref' => route('blog'),
        'secondaryLabel' => __('site.go_blog'),
    ])
@endsection
