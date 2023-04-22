<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ServicesService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;


class HomeController extends Controller
{
    public function index(ServicesService $servicesService): Application|Factory|View
    {
        $products = Product::with('services')->get();
        $chooseUsCategory = $servicesService
            ->getServicesPageWidgetsCategory(config('constants.CHOOSE_US_WIDGET_CATEGORY'));
        $chooseUsWidgets = $servicesService
            ->getServicesPageWidgets(config('constants.CHOOSE_US_WIDGET_CATEGORY'));

        return view('home.index', [
            'products' => $products,
            'chooseUsCategory' => $chooseUsCategory,
            'chooseUsWidgets' => $chooseUsWidgets
        ]);
    }
}
