<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductService;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Services\ServicesService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(ServicesService $servicesService): Application|Factory|View
    {
        $products = Product::with('services')
            ->where('is_active', true)
            ->orderBy('position')->get();

        $productServices = ProductService::all();
        $listOfServices = Service::paginate(20);
        $servicesService->addStyleToService($products, $productServices);

        return view('services.index', [
            'products' => $products,
            'chooseUsCategory' => $servicesService
                ->getServicesPageWidgetsCategory(config('constants.CHOOSE_US_WIDGET_CATEGORY')),
            'chooseUsWidgets' => $servicesService
                ->getServicesPageWidgets(config('constants.CHOOSE_US_WIDGET_CATEGORY')),
            'answerQuestionCategory' => $servicesService
                ->getServicesPageWidgetsCategory(config('constants.ANSWERS_QUESTIONS_WIDGET_CATEGORY')),
            'questionsLeft' => $servicesService
                ->getAnswersQuestionsWidgets(config('constants.ANSWERS_QUESTIONS_WIDGET_CATEGORY'), 'left'),
            'questionsRight' => $servicesService
                ->getAnswersQuestionsWidgets(config('constants.ANSWERS_QUESTIONS_WIDGET_CATEGORY'), 'right'),
            'listOfServices' => $listOfServices,
        ]);
    }

    public function categoryServices(Request $request): Application|Factory|View
    {
        $serviceCategory = ServiceCategory::where('slug', (string) $request->route('serviceCategory'))->firstOrFail();
        $serviceCategories = ServiceCategory::with('service')->get();
        $services = Service::with('serviceCategory')
            ->whereRelation('serviceCategory', 'slug', '=', $serviceCategory->slug)
            ->paginate(5);

        return view('services.service-category.index', [
            'serviceCategory' => $serviceCategory,
            'services' => $services,
            'serviceCategories' => $serviceCategories,
        ]);
    }

    public function serviceShow(Request $request): Application|Factory|View
    {
        $serviceCategory = ServiceCategory::where('slug', (string) $request->route('serviceCategory'))->firstOrFail();
        $service = Service::where('slug', (string) $request->route('service'))
            ->where('service_category_id', $serviceCategory->id)
            ->firstOrFail();
        $serviceCategories = ServiceCategory::all();

        return view('services.service', [
            'service' => $service,
            'serviceCategory' => $serviceCategory,
            'serviceCategories' => $serviceCategories,
        ]);
    }

    public function search()
    {
        $serviceCategories = ServiceCategory::with('service')->get();
        $services = Service::query();
        if (request('search')) {
            $term = '%'.request('search').'%';
            $services
                ->with('serviceCategory')
                ->whereHas('serviceCategory')
                ->where(function ($query) use ($term) {
                    $query->where('title', 'like', $term)
                        ->orWhere('description', 'like', $term);
                });
        }
        if (! $services->count()) {
            return response()->view('errors.nothin-found')->setStatusCode(404);
        }

        return view('services.search', [
            'services' => $services->paginate(5),
            'serviceCategories' => $serviceCategories,
        ]);
    }
}
