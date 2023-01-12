<?php

namespace App\Providers;

use App\Models\Widget;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ContentServiceProvider extends ServiceProvider
{
    public const FOOTER_CATEGORY = 11;

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $footerWidgets = Widget::with('widgetIcon')->where('widget_category_id', '=', self::FOOTER_CATEGORY)->get();
        View::share('footerWidgets', $footerWidgets);
    }
}
