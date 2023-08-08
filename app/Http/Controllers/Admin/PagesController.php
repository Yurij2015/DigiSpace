<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageSaveRequest;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\PageCategory;
use App\Services\PagesService;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;


class PagesController extends Controller
{
    public const EXCLUDED_SLUGS = ['about', 'services', 'pricing', 'promos', 'blog', 'pages', 'contact-us'];
    public function index(PagesService $pagesService): Response
    {
        $pages = $pagesService->filteredPages(self::EXCLUDED_SLUGS, 6);
        return Inertia::render('Admin/Pages/Index', ['pages' => $pages]);
    }

    /**
     * Send pages to view, render page create view.
     * @param PagesService $pagesService
     * @return Response
     */
    final public function pageForm(PagesService $pagesService): Response
    {
        return Inertia::render('Admin/Pages/Create', [
            'menuItems' => $pagesService->filteredMenuItems(self::EXCLUDED_SLUGS),
            'pageCategories' => PageCategory::all(),
            'api_key_tinymce' => config('app.tiny_mce_api_key')
        ]);
    }

    /**
     * Save a newly created post in storage.
     *
     * @param PageSaveRequest $saveRequest
     * @return RedirectResponse
     */
    final public function pageCreate(PageSaveRequest $saveRequest): RedirectResponse
    {
        Page::create($saveRequest->all());
        return redirect(route('admin.pages'))->with('message', 'Page created successfully');
    }

    /**
     * Send pages to view, render page create view.
     * @param Page $page
     * @param PagesService $pagesService
     * @return Response
     */
    final public function pageUpdateForm(Page $page, PagesService $pagesService): Response
    {
        return Inertia::render('Admin/Pages/Update', [
            'menuItems' => $pagesService->filteredMenuItems(self::EXCLUDED_SLUGS),
            'pageCategories' => PageCategory::all(),
            'page' => $page->load('menuItem')->load('pageCategory'),
            'api_key_tinymce' => config('app.tiny_mce_api_key')
        ]);
    }

    /**
     * Save updated page in storage.
     *
     * @param Page $page
     * @param PageSaveRequest $saveRequest
     * @return RedirectResponse
     */
    final public function pageUpdate(Page $page, PageSaveRequest $saveRequest): RedirectResponse
    {
        $page->update($saveRequest->all());
        return redirect(route('admin.pages'))->with('message', 'Page updated successfully');
    }
}
