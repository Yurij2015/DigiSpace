<?php

namespace App\Http\Middleware;

use App\Support\Locales;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = Locales::normalize($request->route('locale'))
            ?? Locales::normalize($request->segment(1)) // unmatched URLs under /{locale}/… hit the fallback route
            ?? Locales::normalize($request->session()->get('locale'))
            ?? Locales::normalize($request->getPreferredLanguage(config('locales.supported')))
            ?? Locales::default();

        app()->setLocale($locale);
        URL::defaults(['locale' => $locale]);

        return $next($request);
    }
}
