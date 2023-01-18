<?php

namespace App\Http\Controllers;
class PageController extends Controller
{
    /**
     * Display the specified resource.
     * @param string $page
     * @return string
     */
    public function show(string $slug): string
    {
        return view('pages.show', ['slug' => $slug]);
    }
}
