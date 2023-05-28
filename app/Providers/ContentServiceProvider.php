<?php

namespace App\Providers;

use App\Models\FooterBottomBarContent;
use App\Models\FooterUsefulLink;
use App\Models\HeaderNavBarContent;
use App\Models\Menu;
use App\Models\Post;
use App\Models\Widget;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ContentServiceProvider extends ServiceProvider
{
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
        try {
            $footerWidgets = Widget::with('widgetIcon')
                ->where('widget_category_id', '=', config('constants.FOOTER_CATEGORY'))
                ->get();
            $pageSubmenuFirst = Menu::with('menuItem')
                ->where('id', '=', config('constants.PAGE_SUBMENU_FIRST'))
                ->get();
            $pageSubmenuSecond = Menu::with('menuItem')
                ->where('id', '=', config('constants.PAGE_SUBMENU_SECOND'))
                ->get();
            $pageSubmenuThird = Menu::with('menuItem')
                ->where('id', '=', config('constants.PAGE_SUBMENU_THIRD'))
                ->get();
            $postsForMenu = Post::limit(config('constants.NUMBER_POSTS_IN_MENU'))
                ->get();
            $footerUsefulLinks = FooterUsefulLink::all()->where('status', '==', true)->take(20);
            $footerLatestNews = Post::orderBy('created_at', 'DESC')->get()->take(2);
            $headerNavBarContent = HeaderNavBarContent::all()->first();
            $footerBottomBarContent = FooterBottomBarContent::all()->first();
            View::share([
                'footerWidgets' => $footerWidgets,
                'pageSubmenuFirst' => $pageSubmenuFirst,
                'pageSubmenuSecond' => $pageSubmenuSecond,
                'pageSubmenuThird' => $pageSubmenuThird,
                'postsForMenu' => $postsForMenu,
                'footerUsefulLinks' => $footerUsefulLinks,
                'footerLatestNews' => $footerLatestNews,
                'headerNavBarContent' => $headerNavBarContent,
                'footerBottomBarContent' => $footerBottomBarContent
            ]);
        } catch (\Exception $e) {
            //
        }

    }
}
