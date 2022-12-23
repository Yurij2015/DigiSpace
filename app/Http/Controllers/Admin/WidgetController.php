<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Widget;
use App\Models\WidgetCategory;
use Inertia\Inertia;
use Inertia\Response;

class WidgetController extends Controller
{
    final public function index(): Response
    {
        return Inertia::render('Admin/Widgets/Index', [
            'widgets' => Widget::with('widgetCategory:id,title')->latest()->get(),
        ]);
    }

    /**
     * Send categories to view, render post create view.
     *
     * @return Response
     */
    final public function widgetForm(): Response
    {
        return Inertia::render('Admin/Widgets/Create', [
            'widgetCcategories' => WidgetCategory::all(),
            'api_key_tinymce' => env('TINY_MCE_API_KEY')
        ]);
    }
}
