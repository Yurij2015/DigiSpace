<?php

namespace App\Services;

use App\Models\Page;
use App\Models\WidgetCategory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ServicesService
{
    public function addStyleToService($products, $productServices): void
    {
        foreach ($products as $product) {
            foreach ($product->services as $service) {
                foreach ($productServices as $productService) {
                    if ($productService->product_id === $product->id && $productService->service_id === $service->id) {
                        $service->css_style = $productService->service_css_class;
                    }
                }
            }
        }
    }

    public function getServicesPageWidgets($widgetCategory): object
    {
        return Page::with(['widgets' => function (BelongsToMany $query) use ($widgetCategory) {
            $query->where('widget_category_id', '=', $widgetCategory);
        }])->where('slug', '=', 'services')->first();
    }

    public function getServicesPageWidgetsCategory($widgetCategory): WidgetCategory
    {
        return WidgetCategory::where('id', '=', $widgetCategory)->first();
    }

    public function getAnswersQuestionsWidgets($widgetCategory, $position): ?object
    {
        return Page::with(['widgets' => function (BelongsToMany $query) use ($widgetCategory, $position) {
            $query->where('widget_category_id', '=', $widgetCategory)
                ->where('subtitle', '=', $position);
        }])->where('slug', '=', 'services')->first();
    }
}
