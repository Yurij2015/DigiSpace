<?php

namespace App\Providers;

use App\Models\FooterBottomBarContent;
use App\Models\FooterUsefulLink;
use App\Models\HeaderNavBarContent;
use App\Models\Menu;
use App\Models\Post;
use App\Models\ServiceCategory;
use App\Models\Widget;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ContentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function (\Illuminate\View\View $view): void {
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
                $postsForMenu = Post::limit(config('constants.NUMBER_POSTS_IN_MENU'))->get();
                $footerUsefulLinks = FooterUsefulLink::query()->where('status', true)->take(20)->get();
                $footerLatestNews = Post::query()->orderByDesc('created_at')->take(2)->get();
                $headerNavBarContent = HeaderNavBarContent::query()->first();
                $footerBottomBarContent = FooterBottomBarContent::query()->first();
                $serviceCategories = ServiceCategory::query()->get();

                $view->with([
                    'footerWidgets' => $footerWidgets,
                    'pageSubmenuFirst' => $pageSubmenuFirst,
                    'pageSubmenuSecond' => $pageSubmenuSecond,
                    'pageSubmenuThird' => $pageSubmenuThird,
                    'postsForMenu' => $postsForMenu,
                    'footerUsefulLinks' => $footerUsefulLinks,
                    'footerLatestNews' => $footerLatestNews,
                    'headerNavBarContent' => $headerNavBarContent,
                    'footerBottomBarContent' => $footerBottomBarContent,
                    'serviceCategories' => $serviceCategories,
                ]);
            } catch (\Throwable) {
                // The application must still render when the database is unavailable.
            }
        });
    }
}
