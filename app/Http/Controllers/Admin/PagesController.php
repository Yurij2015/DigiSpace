<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\PageCategory;
use Illuminate\Database\Eloquent\Collection;
use Inertia\Inertia;
use Inertia\Response;

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
    final public function pageForm(): Response
    {
        return Inertia::render('Admin/Pages/Create', [
            'menuItems' => $this->filteredMenuItems(MenuItem::all()),
            'pageCategories' => PageCategory::all()
        ]);
    }

    private function filteredMenuItems($menuItems): Collection
    {
        $excluledPages = ['about', 'services', 'pricing', 'promos', 'blog', 'pages', 'contact-us'];
        return $menuItems->filter(function (MenuItem $value) use ($excluledPages) {
            return !in_array($value->slug, $excluledPages, true);
        });
    }
}
