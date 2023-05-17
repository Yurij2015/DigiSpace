<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FooterBottomBarSettingsSaveRequest as SaveRequest;
use App\Models\FooterBottomBarContent;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class FooterBottomBarContentController extends Controller
{
    public function index(): Response
    {
        $footerBottomBarContent = FooterBottomBarContent::all()->first();
        return Inertia::render(
            'Admin/FooterBottomBarSettings/Index',
            ['footerBottomBarContent' => $footerBottomBarContent]
        );
    }
    final public function update(FooterBottomBarContent $bottomBarContent, SaveRequest $saveRequest): RedirectResponse
    {
        $bottomBarContent->update($saveRequest->all());
        return redirect(route('admin.bottom-bar-settings'))->with('message', 'Settings Updated Successfully');
    }
}
