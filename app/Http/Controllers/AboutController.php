<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\WidgetCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AboutController extends Controller
{
    public const GENERAL_INFO_WIDGET_CATEGORY = 7;
    public const TEAM_INFO = 8;


    public function index(): Application|Factory|View
    {
        $aboutPageGeneralInfo = Page::with(['widgets' => function (BelongsToMany $query) {
            $query->where('widget_category_id', '=', self::GENERAL_INFO_WIDGET_CATEGORY);
        }])->where('slug', '=', 'about')->first();
        $teamInfoCategoryTitle = (WidgetCategory::where('id', '=', self::TEAM_INFO)->first())->description;
        $teamInfo = Page::with(['widgets' => function (BelongsToMany $query) {
            $query->with('widgetIcon')->where('widget_category_id', '=', self::TEAM_INFO);
        }])->where('slug', '=', 'about')->first();
        return view('about.index',
            [
                'aboutPageGeneralInfo' => $aboutPageGeneralInfo,
                'teamInfo' => $teamInfo,
                'teamInfoCategoryTitle' => $teamInfoCategoryTitle
            ]);
    }
}
