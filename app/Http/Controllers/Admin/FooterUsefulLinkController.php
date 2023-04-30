<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FooterUsefulLinkSaveRequest;
use App\Models\FooterUsefulLink;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class FooterUsefulLinkController extends Controller
{
    final public function index(): Response
    {
        $usefulLinks = FooterUsefulLink::paginate(10);
        return Inertia::render('Admin/FooterUsefulLinks/Index', [
            'usefulLinks' => compact('usefulLinks'),
        ]);
    }

    final public function linkStore(FooterUsefulLinkSaveRequest $saveRequest): RedirectResponse
    {
        FooterUsefulLink::create($saveRequest->all());
        return redirect(route('admin.useful-link-list'));
    }
}
