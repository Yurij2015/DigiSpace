<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display the specified resource.
     * @param string $slug
     * @return Response|View
     */
    public function show(string $slug): Response | View
    {
        $menuItemPage = MenuItem::with('pages')->where('slug', $slug)->firstOrFail();
        if ($menuItemPage->pages->count() === 0) {
            return response()->view('errors.page-not-found')->setStatusCode(404);
        }
        return view('pages.show', [
            'page' => $menuItemPage->pages->first(),
        ]);
    }
}
