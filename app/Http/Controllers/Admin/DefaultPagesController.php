<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Services\DefaultPageService;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Inertia\Inertia;
use Inertia\Response;

class DefaultPagesController extends Controller
{
    public function index(DefaultPageService $defaultPage): Response
    {
        return Inertia::render('Admin/DefaultPages/Index', [
            'defaultPages' => [
                'about' => ['page' => $defaultPage->getPageData('about')],
                'services' => ['page' => $defaultPage->getPageData('services')],
                'pricing' => ['page' => $defaultPage->getPageData('pricing')],
                'promos' => ['page' => $defaultPage->getPageData('promos')],
                'contact-us' => ['page' => $defaultPage->getPageData('contact-us')],
            ],
        ]);
    }

    public function show($pageId): Response
    {
        $page = Page::with(['widgets' => function (BelongsToMany $query) {
            $query->with(['widgetCategory:id,title', 'widgetIcon']);
        }])->where('id', '=', $pageId)->first();
        if ($page) {
            return Inertia::render('Admin/DefaultPages/Show', [
                'widgets' => $page->widgets,
                'pageSlug' => $page->slug,
                'pageId' => $pageId,
            ]);
        }

        return Inertia::render('Admin/DefaultPages/Show', [
            'widgets' => null,
        ]);
    }
}
