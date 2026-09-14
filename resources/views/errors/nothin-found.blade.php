@extends('layouts.main')
@section('title', __('site.service_not_found_title'))
@section('content')
    @include('errors.partials.not-found', [
        'breadcrumb' => __('site.services'),
        'heading' => __('site.service_not_found_heading'),
        'text' => __('site.service_not_found_text'),
        'secondaryHref' => route('services'),
        'secondaryLabel' => __('site.go_services'),
    ])
@endsection
