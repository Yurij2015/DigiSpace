<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceSaveRequest;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
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
        $serviceCategories = ServiceCategory::all();
        $serviceCategories->load('service');

        return Inertia::render('Admin/Services/Create', [
            'serviceCategories' => $serviceCategories,
            'api_key_tinymce' => config('app.tiny_mce_api_key'),
        ]);
    }

    /**
     * Save a newly created post in storage.
     */
    final public function serviceSave(ServiceSaveRequest $saveRequest): RedirectResponse
    {
        $data = $saveRequest->validated();
        $data['slug'] = Str::slug($saveRequest->title);

        Service::create($data);

        return redirect(route('admin.services'))->with('message', 'Service Created Successfully');
    }

    final public function show(Service $service): Response
    {
        return Inertia::render('Admin/Services/Show', [
            'service' => $service->load('serviceCategory'),
        ]);
    }

    final public function serviceUpdateForm(Service $service): Response
    {
        $serviceCategories = ServiceCategory::all();

        return Inertia::render('Admin/Services/Update', [
            'service' => $service,
            'serviceCategories' => $serviceCategories,
            'api_key_tinymce' => config('app.tiny_mce_api_key'),
        ]);
    }

    final public function update(ServiceSaveRequest $saveRequest, Service $service): RedirectResponse
    {
        $data = $saveRequest->validated();

        $service->slug = Str::slug($saveRequest->title);
        $data['slug'] = $service->slug;

        if ($service->image && ! $saveRequest->file) {
            $data['image'] = $service->getRawOriginal('image');
        }

        if ($saveRequest->file) {
            $data['image'] = $this->uploadImage($saveRequest, $service);
        }

        $service->update($data);

        return redirect(route('admin.services'))->with('message', 'Service Updated Successfully');
    }

    final public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        return redirect(route('admin.services'));
    }

    private function uploadImage($request, $service): string
    {
        $extension = $request->file->guessExtension() ?: $request->file->extension() ?: 'jpg';
        $fileName = "service_$service->slug".'_'.time().'.'.$extension;
        $filePath = 'services/'.$fileName;
        Storage::disk('s3')->put($filePath, file_get_contents($request->file));

        return $filePath;
    }
}
