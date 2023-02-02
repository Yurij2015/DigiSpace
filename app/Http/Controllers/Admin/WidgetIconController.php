<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WidgetIcon;
use Inertia\Inertia;
use Inertia\Response;


class WidgetIconController extends Controller
{
    /**
     * @param $widget
     * @return Response
     */
    final public function widgetIcons($widget): Response
    {
        $icons = WidgetIcon::where('widget_id', $widget)->with('widget')->get();
        return Inertia::render('Admin/WidgetIcons/Index', [
            'icons' => $icons,
        ]);
    }
}
