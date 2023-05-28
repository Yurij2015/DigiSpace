<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display the specified resource.
     * @param string $slug
     * @return View
     */
    public function show(string $slug): View
    {
        $menuItemPage = MenuItem::with('pages')->where('slug', $slug)->firstOrFail();
        return view('pages.show', [
            'page' => $menuItemPage->pages->first(),
        ]);
    }
}
