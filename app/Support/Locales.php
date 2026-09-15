<?php

namespace App\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

final class Locales
{
    public static function normalize(?string $locale): ?string
    {
        if ($locale === null || $locale === '') {
            return null;
        }

        $locale = strtolower(str_replace('_', '-', trim($locale)));
        $locale = config('locales.aliases.'.$locale, $locale);

        if (! in_array($locale, config('locales.supported', []), true) && str_contains($locale, '-')) {
            $locale = explode('-', $locale, 2)[0];
            $locale = config('locales.aliases.'.$locale, $locale);
        }

        return in_array($locale, config('locales.supported', []), true) ? $locale : null;
    }

    public static function default(): string
    {
        return (string) config('locales.default', config('app.locale', 'en'));
    }

    public static function fallback(): string
    {
        return (string) config('locales.fallback', config('app.fallback_locale', 'en'));
    }

    /**
     * Prefix a site-relative path with the locale when the result is a localized
     * public route. Absolute URLs, mailto:/tel: links, anchors and paths that are
     * already prefixed (or do not belong to the public site) are returned as-is.
     */
    public static function localizeUrl(string $href, ?string $locale = null): string
    {
        $href = trim($href);

        if ($href === '' || str_starts_with($href, '#') || preg_match('~^(?:[a-z][a-z0-9+.-]*:|//)~i', $href) === 1) {
            return $href;
        }

        $path = '/'.ltrim($href, '/');

        if (in_array(explode('/', ltrim($path, '/'), 2)[0], config('locales.supported', []), true)) {
            return $path;
        }

        return self::localizedPath($path, $locale) ?? $href;
    }

    /**
     * Resolve "/{locale}{path}" when that matches a localized public GET route,
     * otherwise null. Query strings are ignored for matching and re-appended.
     */
    public static function localizedPath(string $path, ?string $locale = null): ?string
    {
        $locale ??= app()->getLocale();
        [$pathOnly, $query] = array_pad(explode('?', $path, 2), 2, null);
        $candidate = '/'.$locale.'/'.ltrim($pathOnly, '/');

        try {
            $route = Route::getRoutes()->match(Request::create($candidate, 'GET'));
        } catch (HttpExceptionInterface) {
            return null;
        }

        if ($route->isFallback || ! in_array($route->getName(), config('locales.route_names', []), true)) {
            return null;
        }

        return rtrim($candidate, '/').($query !== null ? '?'.$query : '');
    }
}
