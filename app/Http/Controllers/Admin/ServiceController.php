<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceSaveRequest;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Request;

class ServiceController extends Controller
{
    public function index(): Response
    {
        $services = Service::all();
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

    final public function update(ServiceSaveRequest $saveRequest, Service $service): RedirectResponse
    {
        $service->update($saveRequest->all());
        return redirect(route('admin.services'))->with('message', 'Service Updated Successfully');
    }

    final public function destroy(Service $service): RedirectResponse
    {
        //
        return redirect(route('admin.services'));
    }

}
