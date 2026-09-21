<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Widget;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Pages whose content moved to service-category URLs; 301 keeps their link equity.
     *
     * @var array<string, array{string, string}>
     */
    public const REDIRECTED_PAGES = [
        'responsive-web-apps' => ['frontend-development', 'responsive-web-apps'],
        'legacy-code-refactoring' => ['support-and-devops', 'legacy-code-refactoring'],
        'crm-and-cms-systems' => ['ecommerce-and-cms', 'custom-crm-cms'],
        'host-your-website-on-ubuntu-servers-with-digispace' => ['support-and-devops', 'linux-hosting-deployment'],
        'opening-incredible-opportunities-php-is-our-1-choice-for-website-development' => ['backend-development', 'php-development'],
        'websites-and-apps-developed-using-javascript-frameworks' => ['frontend-development', 'vue-js-nuxt-development'],
    ];

    public function show(Request $request): Response|View|RedirectResponse
    {
        $slug = (string) $request->route('slug');

        if (isset(self::REDIRECTED_PAGES[$slug])) {
            return redirect()->route('category-service', self::REDIRECTED_PAGES[$slug], 301);
        }

        $menuItemPage = MenuItem::with('pages')->where('slug', $slug)->firstOrFail();
        $pageImage = Widget::where('subtitle', $slug)
            ->where('widget_category_id', config('constants.PAGES_IMAGES'))
            ->first()
            ->widget_image ?? null;
        if ($menuItemPage->pages->count() === 0) {
            return response()->view('errors.page-not-found')->setStatusCode(404);
        }

        return view('pages.show', [
            'page' => $menuItemPage->pages->first(),
            'pageImage' => $pageImage,
        ]);
    }
}
