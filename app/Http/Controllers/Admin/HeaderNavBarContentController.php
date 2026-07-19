<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HeaderNavBarSettingsSaveRequest as SaveRequest;
use App\Models\HeaderNavBarContent;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class HeaderNavBarContentController extends Controller
{
    public function index(): Response
    {
        $headerNavBarContent = HeaderNavBarContent::all()->first();

        return Inertia::render(
            'Admin/HeaderNavBarSettings/Index',
            ['headerNavBarContent' => $headerNavBarContent]
        );
    }

    final public function update(HeaderNavBarContent $headerNavBarContent, SaveRequest $saveRequest): RedirectResponse
    {
        $headerNavBarContent->update($saveRequest->all());

        return redirect(route('admin.top-bar-settings'))->with('message', 'Service Updated Successfully');
    }
}
