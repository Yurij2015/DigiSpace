<?php

namespace App\Http\Middleware;

use App\Support\Locales;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = Locales::normalize($request->route('locale'))
            ?? Locales::normalize($request->getPreferredLanguage(config('locales.supported')))
            ?? Locales::default();

        app()->setLocale($locale);

        return $next($request);
    }
}
