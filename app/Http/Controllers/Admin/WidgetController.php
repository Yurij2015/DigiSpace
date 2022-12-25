<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Widget;
use App\Models\WidgetCategory;
use App\Services\WidgetService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Console\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Inertia\Inertia;
use Inertia\Response;


class WidgetController extends Controller
{
    final public function index(WidgetService $widgetService): Response
    {
        $widgets = Widget::with('widgetCategory:id,title')->latest('id')->get();
        $widgetService->changeImgPathIfNullInWidgets($widgets);
        return Inertia::render('Admin/Widgets/Index', [
            'widgets' => $widgets
        ]);
    }

    /**
     * Send widtetCategories to view, render widget create view.
     * @return Response
     */
    final public function widgetForm(): Response
    {
        return Inertia::render('Admin/Widgets/Create', [
            'widgetCategories' => WidgetCategory::all(),
            'api_key_tinymce' => env('TINY_MCE_API_KEY')
        ]);
    }

    /**
     * Save a newly created post in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     * @throws ValidationException
     */
    final public function widgetSave(Request $request): Application|RedirectResponse|Redirector
    {
        Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'icon' => 'max:255',
            'content' => 'required|string',
            'widget_category_id' => 'int',
            'file' => '',
        ])->validate();
        if ($request->file) {
            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('uploads/widgets'), $fileName);
        } else {
            $fileName = NULL;
        }
        Widget::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'content' => $request['content'],
            'widget_category_id' => $request->widget_category_id,
            'icon' => $request->icon,
            'widget_image' => $fileName
        ]);
        return redirect(route('admin.widgets'))->with('message', 'Widget Created Successfully');
    }

    /**
     * Send widget and widtetCategories to view, render widget update view.
     * @param $widget
     * @param WidgetService $widgetService
     * @return Response
     */
    final public function widgetUpdateForm($widget, WidgetService $widgetService): Response
    {
        $widget = Widget::where('id', $widget)->first();
        $widgetService->changeImgPathIfNull($widget);

        return Inertia::render('Admin/Widgets/Update', [
            'widget' => $widget,
            'widgetCategories' => WidgetCategory::all(),
            'api_key_tinymce' => env('TINY_MCE_API_KEY')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Widget $widget
     * @return Application|Redirector|RedirectResponse
     * @throws AuthorizationException
     */
    final public function widgetUpdate(Request $request, Widget $widget): Redirector|RedirectResponse|Application
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'icon' => 'max:255',
            'content' => 'required|string',
            'widget_category_id' => 'int',
            'file' => '',
        ]);
        if ($request->file) {
            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('uploads/widgets'), $fileName);
            $widget->widget_image = $fileName;
        }
        $widget->update($validated);
        return redirect(route('admin.widgets'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Widget $widget
     * @return Application|Redirector|RedirectResponse
     */
    final public function widgetDestroy(Widget $widget): Redirector|RedirectResponse|Application
    {
        $widget->delete();
        return redirect(route('admin.widgets'));
    }
}
