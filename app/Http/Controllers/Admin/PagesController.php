<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\PageCategory;
use App\Services\PagesService;
use Illuminate\Console\Application;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


class PagesController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Pages/Index');
    }

    /**
     * Send pages to view, render page create view.
     * @return Response
     */
    final public function pageForm(PagesService $pagesService): Response
    {
        return Inertia::render('Admin/Pages/Create', [
            'menuItems' => $pagesService->filteredMenuItems(MenuItem::all()),
            'pageCategories' => PageCategory::all()
        ]);
    }

    /**
     * Save a newly created post in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     * @throws ValidationException
     */
    final public function pageCreate(Request $request): Application|RedirectResponse|Redirector
    {
        Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'meta' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'content' => 'required|string',
            'slug' => 'required|string',
        ])->validate();

        Page::create([
            'name' => $request->name,
            'meta' => $request->meta,
            'description' => $request->description,
            'content' => $request['content'],
            'slug' => $request->slug,
            'page_category_id' => $request->page_category_id,
            'menu_item_id' => $request->menu_item_id,
        ]);
        return redirect(route('admin.pages'))->with('message', 'Page created successfully');
    }
}
