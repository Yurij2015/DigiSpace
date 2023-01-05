<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Query\Builder;


class AboutController extends Controller
{
    public const GENERAL_INFO_WIDGET_CATEGORY = 7;

    public function index(): Application|Factory|View
    {
        $aboutPageGeneralInfo = Page::with('widgets')->whereHas('widgets', function ($q) {
            $q->where('widget_category_id', self::GENERAL_INFO_WIDGET_CATEGORY);
        })->where('slug', '=', 'about')->get();
        return view('about.index', ['aboutPageGeneralInfo' => $aboutPageGeneralInfo]);
    }
}
