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
        // The legacy Inertia admin edits base-language columns only; serialising models
        // through the locale-aware accessors in another language would feed translations
        // into its forms. Pin those requests to the default locale.
        if ($request->is('admin', 'admin/*', 'portfolio', 'portfolio/*')) {
            app()->setLocale(Locales::default());
            URL::defaults(['locale' => Locales::default()]);

            return $next($request);
        }

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
