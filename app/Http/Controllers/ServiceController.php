<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductService;
use App\Models\Service;
use App\Services\ServicesService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;


class ServiceController extends Controller
{
    public function index(ServicesService $servicesService): Application|Factory|View
    {
        $products = Product::with('services')->get();
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
            'listOfServices' => $listOfServices
        ]);
    }
}
