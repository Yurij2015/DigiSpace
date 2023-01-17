<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Widget;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ContentServiceProvider extends ServiceProvider
{
    public const FOOTER_CATEGORY = 11;
    public const PAGE_SUBMENU_FIRST = 2;
    public const PAGE_SUBMENU_SECOND = 3;
    public const PAGE_SUBMENU_THIRD = 4;
    public const FOOTER_SUBMENU = 5;


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
        $pageSubmenuFirst = Menu::with('menuItem')->where('id', '=', self::PAGE_SUBMENU_FIRST)->get();
        $pageSubmenuSecond = Menu::with('menuItem')->where('id', '=', self::PAGE_SUBMENU_SECOND)->get();
        $pageSubmenuThird = Menu::with('menuItem')->where('id', '=', self::PAGE_SUBMENU_THIRD)->get();

        View::share([
            'footerWidgets' => $footerWidgets,
            'pageSubmenuFirst' => $pageSubmenuFirst,
            'pageSubmenuSecond' => $pageSubmenuSecond,
            'pageSubmenuThird' => $pageSubmenuThird
        ]);
    }
}
