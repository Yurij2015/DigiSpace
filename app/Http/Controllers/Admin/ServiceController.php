<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceSaveRequest;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Str;

class ServiceController extends Controller
{
    public function index(): Response
    {
        $services = Service::paginate(config('constants.SERVICES_PER_PAGE'));
        return Inertia::render('Admin/Services/Index', ['services' => $services]);
    }

    final public function serviceForm(): Response
    {
        return Inertia::render('Admin/Services/Create');
    }

    /**
     * Save a newly created post in storage.
     *
     * @param ServiceSaveRequest $saveRequest
     * @return RedirectResponse
     */
    final public function serviceSave(ServiceSaveRequest $saveRequest): RedirectResponse
    {
        Service::create($saveRequest->all());
        return redirect(route('admin.services'))->with('message', 'Service Created Successfully');
    }

    final public function show(Service $service): Response
    {
        return Inertia::render('Admin/Services/Show', [
            'service' => $service,
        ]);
    }

    final public function serviceUpdateForm(Service $service): Response
    {
        return Inertia::render('Admin/Services/Update', [
            'service' => $service,
        ]);
    }

    final public function update(Request $saveRequest, Service $service): RedirectResponse
    {

        $slug = Str::slug($saveRequest->title);
        $image = $service->image ?? null;

        if ($saveRequest->file) {
            $fileName = "service_$slug" . "_" . time() . '.' . $saveRequest->file->extension();
            $saveRequest->file->move(public_path('uploads'), $fileName);
            $image = $fileName;
        }

        $service->update([
            'title' => $saveRequest->title,
            'details' => $saveRequest->details,
            'price' => $saveRequest->price,
            'service_category_id' => $saveRequest->service_category_id,
            'seo_keywords' => $saveRequest->seo_keywords,
            'seo_description' => $saveRequest->seo_description,
            'seo_title' => $saveRequest->seo_title,
            'image_alt' => $saveRequest->image_alt,
            'image' => $image,
            'description' => $saveRequest->description,
            'slug' => $slug,
        ]);

        return redirect(route('admin.services'))->with('message', 'Service Updated Successfully');
    }

    final public function destroy(Service $service): RedirectResponse
    {
        $service->delete();
        return redirect(route('admin.services'));
    }

}
