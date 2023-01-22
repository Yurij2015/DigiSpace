<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\WidgetCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class PromoController extends Controller
{
    public const PROMOS = 14;

    public function index(): Application|Factory|View
    {
        $promosCategory = $this->getPromosPageWidgetsCategory(self::PROMOS);
        $promosWidgets = $this->getPromosPageWidgets(self::PROMOS);
        $page = Page::where('slug', '=', 'promos')->first();
        return view('promo.index', [
            'promosCategory' => $promosCategory,
            'promosWidgets' => $promosWidgets,
            'page' => $page
        ]);
    }

    private function getPromosPageWidgets($widgetCategory)
    {
        return Page::with(['widgets' => function (BelongsToMany $query) use ($widgetCategory) {
            $query->where('widget_category_id', '=', $widgetCategory);
        }])->where('slug', '=', 'promos')->first();
    }

    private function getPromosPageWidgetsCategory($widgetCategory): WidgetCategory
    {
        return WidgetCategory::where('id', '=', $widgetCategory)->first();
    }
}
