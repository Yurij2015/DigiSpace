<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductSaveRequest;
use App\Models\Product;
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

    final public function productUpdateForm(Product $product): Response
    {
        return Inertia::render('Admin/Products/Update', [
            'product' => $product,
        ]);
    }

    /**
     * Save a newly created post in storage.
     *
     * @param ProductSaveRequest $saveRequest
     * @return RedirectResponse
     */
    final public function productSave(ProductSaveRequest $saveRequest): RedirectResponse
    {
        Product::create($saveRequest->all());
        return redirect(route('admin.products'))->with('message', 'Product Created Successfully');
    }


    final public function update(ProductSaveRequest $saveRequest, Product $product): RedirectResponse
    {
        $product->update($saveRequest->all());
        return redirect(route('admin.products'));
    }

    final public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect(route('admin.products'));
    }
}
