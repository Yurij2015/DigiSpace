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
        // A '*' composer fires for every rendered view — layout, components, partials —
        // so the shared payload is queried once per request and reused for each of them.
        $chrome = null;

        View::composer('*', function (\Illuminate\View\View $view) use (&$chrome): void {
            $chrome ??= $this->siteChrome();

            if ($chrome !== []) {
                $view->with($chrome);
            }
        });
    }

    /**
     * @return array<string, mixed>
     */
    private function siteChrome(): array
    {
        try {
            return [
                'footerWidgets' => Widget::with('widgetIcon')
                    ->where('widget_category_id', '=', config('constants.FOOTER_CATEGORY'))
                    ->get(),
                'pageSubmenuFirst' => Menu::with('menuItem')
                    ->where('id', '=', config('constants.PAGE_SUBMENU_FIRST'))
                    ->get(),
                'pageSubmenuSecond' => Menu::with('menuItem')
                    ->where('id', '=', config('constants.PAGE_SUBMENU_SECOND'))
                    ->get(),
                'pageSubmenuThird' => Menu::with('menuItem')
                    ->where('id', '=', config('constants.PAGE_SUBMENU_THIRD'))
                    ->get(),
                'postsForMenu' => Post::published()
                    ->latest()
                    ->limit(config('constants.NUMBER_POSTS_IN_MENU'))
                    ->get(),
                'factsWidgets' => Widget::where('widget_category_id', config('constants.FACTS_WIDGET_CATEGORY'))
                    ->orderBy('id')
                    ->take(4)
                    ->get(),
                'footerUsefulLinks' => FooterUsefulLink::query()->where('status', true)->take(20)->get(),
                'footerLatestNews' => Post::published()->latest()->take(2)->get(),
                'headerNavBarContent' => HeaderNavBarContent::query()->first(),
                'footerBottomBarContent' => FooterBottomBarContent::query()->first(),
                'serviceCategories' => ServiceCategory::query()->get(),
            ];
        } catch (\Throwable) {
            // The application must still render when the database is unavailable.
            return [];
        }
    }
}
