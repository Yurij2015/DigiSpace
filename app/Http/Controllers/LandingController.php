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


        return Inertia::render('Landing', [
            'widgets' => [
                'widgetHeader' => $widgetHeader,
                'widgetMiddleLeft' => $widgetMiddleLeft,
                'widgetMiddleCenter' => $widgetMiddleCenter,
                'widgetMiddleRight' => $widgetMiddleRight
            ],
        ]);
    }
}
