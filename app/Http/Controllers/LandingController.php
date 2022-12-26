<?php

namespace App\Http\Controllers;

use App\Models\Widget;
use Inertia\Inertia;
use Inertia\Response;

class LandingController extends Controller
{
    public function index(): Response
    {
        $widgetHeader = Widget::where('id', 1)->first();
        $widgetMiddleLeft = Widget::where('id', 2)->first();
        $widgetMiddleCenter = Widget::where('id', 3)->first();
        $widgetMiddleRight = Widget::where('id', 4)->first();
        $widgetBodyTopLeft = Widget::where('id', 5)->first();
        $widgetBodyTopRight = Widget::where('id', 6)->first();
        $widgetBodyBottomLeft = Widget::where('id', 7)->first();
        $widgetBodyBottomRight = Widget::with('widgetIcon')->where('id', 8)->latest()->first();

        return Inertia::render('Landing', [
            'widgets' => [
                'widgetHeader' => $widgetHeader,
                'widgetMiddleLeft' => $widgetMiddleLeft,
                'widgetMiddleCenter' => $widgetMiddleCenter,
                'widgetMiddleRight' => $widgetMiddleRight,
                'widgetBodyTopLeft' => $widgetBodyTopLeft,
                'widgetBodyTopRight' => $widgetBodyTopRight,
                'widgetBodyBottomLeft' => $widgetBodyBottomLeft,
                'widgetBodyBottomRight' => $widgetBodyBottomRight
            ],
        ]);
    }
}
