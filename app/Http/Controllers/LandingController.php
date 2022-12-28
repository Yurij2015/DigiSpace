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
        $widgetBodyTopSecondLeft = Widget::where('id', 7)->first();
        $widgetBodyTopSecondRight = Widget::with('widgetIcon')->where('id', 8)->latest()->first();
        $widgetBodyMiddleTop = Widget::where('id', 9)->first();
        $widgetBodyMiddleCenter = Widget::with('widgetIcon')->where('widget_category_id', 4)->where('widget_image', '<>', null)->get();
        $widgetBodyBottomTop = Widget::where('id', 14)->first();
        $widgetBodyBottomMiddle = Widget::where('widget_category_id', 5)->where('icon', '<>', null)->get();
        $widgetBodyContactForm = Widget::where('id', 18)->first();
        $widgetFooter = Widget::with('widgetIcon')->where('id', 19)->first();

        return Inertia::render('Landing', [
            'widgets' => [
                'widgetHeader' => $widgetHeader,
                'widgetMiddleLeft' => $widgetMiddleLeft,
                'widgetMiddleCenter' => $widgetMiddleCenter,
                'widgetMiddleRight' => $widgetMiddleRight,
                'widgetBodyTopLeft' => $widgetBodyTopLeft,
                'widgetBodyTopRight' => $widgetBodyTopRight,
                'widgetBodyTopSecondLeft' => $widgetBodyTopSecondLeft,
                'widgetBodyTopSecondRight' => $widgetBodyTopSecondRight,
                'widgetBodyMiddleTop' => $widgetBodyMiddleTop,
                'widgetBodyMiddleCenter' => $widgetBodyMiddleCenter,
                'widgetBodyBottomTop' => $widgetBodyBottomTop,
                'widgetBodyBottomMiddle' => $widgetBodyBottomMiddle,
                'widgetBodyContactForm' => $widgetBodyContactForm,
                'widgetFooter' => $widgetFooter
            ],
        ]);
    }
}
