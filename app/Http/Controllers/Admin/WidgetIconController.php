<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WidgetIcon;
use Illuminate\Console\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;


class WidgetIconController extends Controller
{
    /**
     * @param $widget
     * @param Request $request
     * @return Response
     */
    final public function widgetIcons($widget, Request $request): Response
    {
        $icons = WidgetIcon::where('widget_id', $widget)->with('widget')->get();
        return Inertia::render('Admin/WidgetIcons/Index', [
            'icons' => $icons,
            'page' => $request->page
        ]);
    }

    /**
     * @param WidgetIcon $widgetIcon
     * @param Request $request
     * @return Response
     */
    final public function widgetIconUpdateForm(WidgetIcon $widgetIcon, Request $request): Response
    {
        $icon = WidgetIcon::where('id', $widgetIcon->id)->with('widget')->first();
        return Inertia::render('Admin/WidgetIcons/Update', [
            'icon' => $icon,
            'page' => $request->page
        ]);
    }

    /**
     * Update the widget icons resource in storage.
     *
     * @param Request $request
     * @param WidgetIcon $widgetIcon
     * @return Application|Redirector|RedirectResponse
     */
    final public function widgetIconUpdate(Request $request, WidgetIcon $widgetIcon): Redirector|RedirectResponse|Application
    {
        $validated = $request->validate([
            'icon_class' => 'string|max:255',
            'description' => 'string|max:255',
            'url' => 'string|max:255|nullable',
            'css_class' => 'string|max:255',
        ]);

        $widgetIcon->update($validated);
        return redirect(route('admin.widget-icons', $widgetIcon->widget_id) . '?page=' . $request->page);
    }
}
