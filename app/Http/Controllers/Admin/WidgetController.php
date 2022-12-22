<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Widget;
use Inertia\Inertia;
use Inertia\Response;

class WidgetController extends Controller
{
    final public function index(): Response
    {
        return Inertia::render('Admin/Widgets/Index', [
//            'widgets' => Widget::all(),
            'widgets' => Widget::with('widgetCategory:id,title')->latest()->get(),
        ]);
    }
}
