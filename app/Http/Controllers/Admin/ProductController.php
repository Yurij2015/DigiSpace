<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductSaveRequest;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function index(): Response
    {
        $products = Product::all();

        return Inertia::render('Admin/Products/Index', ['products' => $products]);
    }

    final public function show(Product $product): Response
    {
        $product->load('services', 'services.serviceStyle');

        return Inertia::render('Admin/Products/Show', [
            'product' => $product,
        ]);
    }

    final public function productForm(): Response
    {
        return Inertia::render('Admin/Products/Create');
    }

    final public function productUpdateForm(Product $product): Response
    {
        $services = Service::get();
        $product->load('services', 'services');

        return Inertia::render('Admin/Products/Update', [
            'product' => $product,
            'services' => $services,
        ]);
    }

    /**
     * Save a newly created post in storage.
     */
    final public function productSave(ProductSaveRequest $saveRequest): RedirectResponse
    {
        $validated = $saveRequest->validated();

        Product::create($validated);

        return redirect(route('admin.products'))->with('message', 'Product Created Successfully');
    }

    final public function update(ProductSaveRequest $saveRequest, Product $product): RedirectResponse
    {
        $validated = $saveRequest->validated();

        $product->update($validated);

        if (isset($validated['services'])) {
            $product->services()->sync($validated['services']);
        } else {
            $product->services()->sync([]);
        }

        return redirect(route('admin.products'));
    }

    final public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect(route('admin.products'));
    }

    final public function productServicesStyle(Product $product): Response
    {
        $product->load('services', 'services.serviceStyle');
        $productServices = $product->services;

        return Inertia::render('Admin/Products/Services/CssStyles', [
            'productServices' => $productServices,
            'product' => $product,
        ]);
    }

    public function saveProductServiceStyle(Product $product, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'servicesStyles' => 'required|array',
            'servicesStyles.service_style.*.id' => 'required|integer|exists:services,id',
        ]);

        foreach ($validated['servicesStyles'] as $service) {
            $savedService = Service::find($service['id']);
            $savedService->load('serviceStyle');
            $serviceStyle = $savedService->serviceStyle;

            if ($service && $serviceStyle) {
                $serviceStyle->service_css_class = $service['service_style']['service_css_class'];
                $serviceStyle->save();
            }
        }

        return redirect(route('admin.product-services-style', $product->id));
    }
}
