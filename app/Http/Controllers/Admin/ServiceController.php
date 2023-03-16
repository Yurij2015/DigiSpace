<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

    final public function show(Service $service): Response
    {
        return Inertia::render('Admin/Services/Show', [
            'service' => $service,
        ]);
    }

    final public function update(Request $request, Service $service): RedirectResponse
    {
        //
        return redirect(route('admin.services'));
    }

    final public function destroy(Service $service): RedirectResponse
    {
        //
        return redirect(route('admin.services'));
    }

}
