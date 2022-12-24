<?php

namespace App\Services;

use Illuminate\Support\Facades\URL;

class WidgetService
{
    final public function changeImgPathIfNullInWidgets($widgets): void
    {
        foreach ($widgets as $widget) {
            $this->changeImgPathIfNull($widget);
        }
    }

    final public function changeImgPathIfNull($widget): void
    {
        if ($widget->widget_image === URL::to('/') . '/uploads/widgets') {
            $widget->widget_image = 'no_image.png';
        }
    }
}
