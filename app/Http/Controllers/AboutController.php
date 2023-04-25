<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\WidgetCategory;
use App\Services\AboutService;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AboutController extends Controller
{
    public const GENERAL_INFO_WIDGET_CATEGORY = 7;
    public const TEAM_INFO = 8;
    public const SOME_FACTS_ABOUT = 9;

    public function index(AboutService $aboutService)
    {
        return view('about.index', [
            'aboutPageGeneralInfo' => $aboutService->getAboutPageComponent(self::GENERAL_INFO_WIDGET_CATEGORY),
            'teamInfoCategoryTitle' => $aboutService->getAboutPageComponentCategory(self::TEAM_INFO)->description,
            'teamInfo' => $aboutService->getAboutPageComponent(self::TEAM_INFO),
            'someFactsAboutCategory' => $aboutService->getAboutPageComponentCategory(self::SOME_FACTS_ABOUT),
            'someFactsAbout' => $aboutService->getAboutPageComponent(self::SOME_FACTS_ABOUT),
            'clientsCategory' => $aboutService->getAboutPageComponentCategory(config('constants.WIDGET_CATEGORY_PROJECTS')),
            'clients' => $aboutService->getAboutPageComponent(config('constants.WIDGET_CATEGORY_PROJECTS'))
        ]);
    }
}
