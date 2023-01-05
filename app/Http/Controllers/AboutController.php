<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;


class AboutController extends Controller
{
    public function index(): Application|Factory|View
    {
        $aboutPage = Page::with('widgets')->where('slug', '=', 'about')->get();
        return view('about.index', ['aboutPage' => $aboutPage]);
    }
}
