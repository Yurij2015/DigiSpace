<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Request;


class ProductController extends Controller
{
    public function index(): Response
    {
        $products = Product::all();
        return Inertia::render('Admin/Products/Index', ['products' => $products]);
    }

    final public function show(Product $product): Response
    {
        return Inertia::render('Admin/Products/Show', [
            'product' => $product->load('services'),
        ]);
    }

    final public function productForm(): Response
    {
        return Inertia::render('Admin/Products/Create');
    }


    final public function update(Request $request, Product $product): RedirectResponse
    {
        //
        return redirect(route('admin.products'));
    }

    final public function destroy(Product $product): RedirectResponse
    {
        //
        return redirect(route('admin.products'));
    }
}
