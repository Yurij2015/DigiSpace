<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PageController extends Controller
{
    /**
     * Display the specified resource.
     * @param string $slug
     * @return Application|\Illuminate\Http\RedirectResponse|
     */
    public function show(string $slug): RedirectResponse|View
    {
        $menuItemPage = MenuItem::with('pages')->where('slug', $slug)->firstOrFail();
        if ($menuItemPage->pages->count() === 0) {
            return redirect(route('error-404'));
        }
        return view('pages.show', [
            'page' => $menuItemPage->pages->first(),
        ]);
    }
}
