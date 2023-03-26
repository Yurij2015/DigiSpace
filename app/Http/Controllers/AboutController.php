<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\WidgetCategory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AboutController extends Controller
{
    public const GENERAL_INFO_WIDGET_CATEGORY = 7;
    public const TEAM_INFO = 8;
    public const SOME_FACTS_ABOUT = 9;
    public const CLIENTS = 10;

    public function index()
    {
        return view('about.index', [
            'aboutPageGeneralInfo' => $this->getAboutPageComponent(self::GENERAL_INFO_WIDGET_CATEGORY),
            'teamInfoCategoryTitle' => $this->getAboutPageComponentCategory(self::TEAM_INFO)->description,
            'teamInfo' => $this->getAboutPageComponent(self::TEAM_INFO),
            'someFactsAboutCategory' => $this->getAboutPageComponentCategory(self::SOME_FACTS_ABOUT),
            'someFactsAbout' => $this->getAboutPageComponent(self::SOME_FACTS_ABOUT),
            'clientsCategory' => $this->getAboutPageComponentCategory(self::CLIENTS),
            'clients' => $this->getAboutPageComponent(self::CLIENTS)
        ]);
    }

    private function getAboutPageComponent($widgetCategory)
    {
        return Page::with(['widgets' => function (BelongsToMany $query) use ($widgetCategory) {
            $query->where('widget_category_id', '=', $widgetCategory);
        }])->where('slug', '=', 'about')->first();
    }

    private function getAboutPageComponentCategory($widgetCategory): WidgetCategory
    {
        return WidgetCategory::where('id', '=', $widgetCategory)->first();
    }
}
