<?php

namespace App\Services;

use App\Models\Page;
use App\Models\WidgetCategory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AboutService
{
    public function getAboutPageComponent($widgetCategory): ?object
    {
        return Page::with(['widgets' => function (BelongsToMany $query) use ($widgetCategory) {
            $query->where('widget_category_id', '=', $widgetCategory);
        }])->where('slug', '=', 'about')->first();
    }

    public function getAboutPageComponentCategory($widgetCategory): WidgetCategory
    {
        return WidgetCategory::where('id', '=', $widgetCategory)->first();
    }
}
