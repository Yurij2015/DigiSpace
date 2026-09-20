<?php

namespace App\Http\Controllers;

use App\Support\Locales;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Fallback for public URLs that pre-date the {locale} prefix (/about, /blog/{slug}, /faq, …).
 * Re-matches the path under the locale resolved by SetLocale and redirects there;
 * anything that still does not match a localized public route is a plain 404.
 */
class LegacyUrlRedirectController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        if (! in_array($request->method(), ['GET', 'HEAD'], true) || Locales::normalize($request->segment(1)) !== null) {
            abort(404); // only GET links pre-date the prefix; already-localized paths have nothing to re-match
        }

        $localizedPath = Locales::localizedPath($request->getRequestUri());

        abort_if($localizedPath === null, 404);

        return redirect()->to($localizedPath, 301)->header('Vary', 'Accept-Language');
    }
}
