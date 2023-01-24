<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class BlogController extends Controller
{
    public function index(): Application|Factory|View
    {
        return view('blog.index');
    }

    public function show(string $slug): string
    {
        return view('blog.post_show', ['slug' => $slug]);
    }
}
