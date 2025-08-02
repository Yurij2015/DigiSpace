<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Widget;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PageController extends Controller
{
    public function show(string $slug): Response|View
    {
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
