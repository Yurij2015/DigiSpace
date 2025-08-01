<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Widget;
use App\Models\WidgetCategory;
use App\Services\WidgetService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;


class WidgetController extends Controller
{
    final public function index(WidgetService $widgetService): Response
    {
        $widgets = Widget::with('widgetCategory:id,title')
            ->with('widgetIcon')
            ->latest('id')
            ->paginate(config('constants.WIDGET_PER_PAGE'));
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
            'api_key_tinymce' => config('app.tiny_mce_api_key')
        ]);
    }

    /**
     * Save a newly created post in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    final public function widgetSave(Request $request): RedirectResponse
    {
        Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'subtitle' => 'max:255',
            'icon' => 'max:255',
            'content' => 'required|string',
            'widget_category_id' => 'int',
            'file' => '',
        ])->validate();

        $newWidget = Widget::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'content' => $request['content'],
            'widget_category_id' => $request->widget_category_id,
            'icon' => $request->icon
        ]);

        if ($request->file) {
            $fileName = $this->storeWidgetImageOnMinio($request, $newWidget);
        } else {
            $fileName = null;
        }

        $newWidget->widget_image = $fileName;
        $newWidget->save();

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
            'api_key_tinymce' => config('app.tiny_mce_api_key')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Widget $widget
     * @return RedirectResponse
     */
    final public function widgetUpdate(Request $request, Widget $widget): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'max:255',
            'icon' => 'max:255',
            'content' => 'required|string',
            'widget_category_id' => 'int',
            'file' => '',
        ]);

        if ($request->file) {
            $fileName = $this->storeWidgetImageOnMinio($request, $widget);

            $widget->widget_image = $fileName;
        }

        $widget->update($validated);
        return redirect(route('admin.widgets'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Widget $widget
     * @return RedirectResponse
     */
    final public function widgetDestroy(Widget $widget): RedirectResponse
    {
        $widget->delete();
        return redirect(route('admin.widgets'));
    }

    private function storeWidgetImageOnMinio(Request $request, Widget $widget): string
    {
        $fileName = null;

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imageName = time() . '.' . $image->extension();
            $filePath = 'widgets/' . $widget->id . "/" . $imageName;

            Storage::disk('s3')->put($filePath, file_get_contents($image));
            $fileName = Storage::disk('s3')->url($filePath);
        }

        return $fileName;
    }
}
