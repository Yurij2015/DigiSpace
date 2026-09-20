{{-- Rendered by Laravel for every unmatched public URL (see LegacyUrlRedirectController). --}}
@if(isset($headerNavBarContent, $footerBottomBarContent))
    @include('errors.page-not-found')
@else
    {{-- Site chrome rows are missing (empty or unreachable database): a self-contained page instead of a 500. --}}
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ __('site.not_found_title') }}</title>
        <link rel="icon" href="{{ asset('favicons/site.svg') }}" type="image/svg+xml">
        <style>
            body { margin: 0; font: 16px/1.5 Arial, sans-serif; color: #151515; background: #fff; text-align: center; padding: 64px 16px; }
            h1 { font-size: 28px; margin: 0 0 12px; }
            a { color: #00a9ff; }
        </style>
    </head>
    <body>
        <h1>{{ __('site.not_found_heading') }}</h1>
        <p>{{ __('site.not_found_text') }}</p>
        <p><a href="{{ route('home.index', ['locale' => app()->getLocale()]) }}">{{ __('site.go_home') }}</a></p>
    </body>
    </html>
@endif
