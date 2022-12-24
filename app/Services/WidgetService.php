<?php

namespace App\Services;

class WidgetService
{
    final public function changeImgPathIfNullInPosts($widgets): void
    {
        foreach ($widgets as $widget) {
            $this->changeImgPathIfNull($widget);
        }
    }

    final public function changeImgPathIfNull($widget): void
    {
        if ($widget->widget_image === 'http://localhost/uploads/widgets' || $widget->widget_image === 'https://localhost/uploads/widgets') {
            $widget->widget_image = 'no_image.png';
        }
    }
}
