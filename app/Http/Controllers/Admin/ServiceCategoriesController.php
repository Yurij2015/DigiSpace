<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceCategorySaveRequest;
use App\Models\ServiceCategory;
use Inertia\Inertia;
use Inertia\Response;

class ServiceCategoriesController extends Controller
{
    public function index(): Response
    {
        $categories = ServiceCategory::paginate(config('constants.SERVICE_CATEGORIES_PER_PAGE'));

        return Inertia::render('Admin/ServiceCategories/Index', compact('categories'));
    }

    public function store(ServiceCategorySaveRequest $request)
    {
        ServiceCategory::create($request->validated());

        return redirect()->route('admin.service-categories');
    }

    public function update(ServiceCategorySaveRequest $request, ServiceCategory $serviceCategory)
    {
        $serviceCategory->update($request->validated());

        return redirect()->route('admin.service-categories');
    }
}
