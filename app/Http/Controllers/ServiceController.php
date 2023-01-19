<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductService;
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
        $servicesService->addStyleToService($products, $productServices);
        return view('services.index', ['products' => $products]);
    }
}
