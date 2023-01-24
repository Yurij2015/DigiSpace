<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Product;
use App\Models\ProductService;
use App\Models\WidgetCategory;
use App\Services\ServicesService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class ServiceController extends Controller
{
    public const CHOOSE_US = 12;
    public const ANSWERS_QUESTIONS = 13;

    public function index(ServicesService $servicesService): Application|Factory|View
    {
        $products = Product::with('services')->get();
        $productServices = ProductService::all();
        $servicesService->addStyleToService($products, $productServices);
        return view('services.index', [
            'products' => $products,
            'chooseUsCategory' => $this->getServicesPageWidgetsCategory(self::CHOOSE_US),
            'chooseUsWidgets' => $this->getServicesPageWidgets(self::CHOOSE_US),
            'answerQuestionCategory' => $this->getServicesPageWidgetsCategory(self::ANSWERS_QUESTIONS),
            'questionsLeft' => $this->getAnswersQuestionsWidgets(self::ANSWERS_QUESTIONS, 'left'),
            'questionsRight' => $this->getAnswersQuestionsWidgets(self::ANSWERS_QUESTIONS, 'right')
        ]);
    }

    private function getAnswersQuestionsWidgets($widgetCategory, $position)
    {
        return Page::with(['widgets' => function (BelongsToMany $query) use ($widgetCategory, $position) {
            $query->where('widget_category_id', '=', $widgetCategory)
                ->where('subtitle', '=', $position);
        }])->where('slug', '=', 'services')->first();
    }

    private function getServicesPageWidgets($widgetCategory)
    {
        return Page::with(['widgets' => function (BelongsToMany $query) use ($widgetCategory) {
            $query->where('widget_category_id', '=', $widgetCategory);
        }])->where('slug', '=', 'services')->first();
    }

    private function getServicesPageWidgetsCategory($widgetCategory): WidgetCategory
    {
        return WidgetCategory::where('id', '=', $widgetCategory)->first();
    }
}
