<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Widget;
use App\Models\WidgetIcon;
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
     * @param $iconId
     * @return Response
     */
    final public function widgetIconUpdateForm($iconId, Request $request): Response
    {
        $icon = WidgetIcon::where('id', $iconId)->with('widget')->first();
        return Inertia::render('Admin/WidgetIcons/Update', [
            'icon' => $icon,
            'page' => $request->page
        ]);
    }
}
