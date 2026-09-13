<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\ControlOverview;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('control')
            ->path('control')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->navigationItems([
                NavigationItem::make('Education')
                    ->group('Portfolio management')
                    ->icon('heroicon-o-academic-cap')
                    ->url(fn (): string => route('portfolio.education')),
                NavigationItem::make('Skills')
                    ->group('Portfolio management')
                    ->icon('heroicon-o-check-badge')
                    ->url(fn (): string => route('portfolio.skills')),
                NavigationItem::make('Section Management')
                    ->group('Portfolio management')
                    ->icon('heroicon-o-wrench-screwdriver')
                    ->url(fn (): string => route('portfolio.sections')),
                NavigationItem::make('Pages')
                    ->group('Admin Layout Pages')
                    ->icon('heroicon-o-document-text')
                    ->url(fn (): string => route('filament.control.resources.pages.index')),
                NavigationItem::make('Posts')
                    ->group('Admin Layout Pages')
                    ->icon('heroicon-o-rectangle-stack')
                    ->url(fn (): string => route('filament.control.resources.posts.index')),
                NavigationItem::make('Admin')
                    ->group('Admin Layout Pages')
                    ->icon('heroicon-o-tv')
                    ->url(fn (): string => route('admin')),
                NavigationItem::make('Categories')
                    ->group('Admin Layout Pages')
                    ->icon('heroicon-o-table-cells')
                    ->url(fn (): string => route('admin.categories')),
                NavigationItem::make('Widgets')
                    ->group('Admin Layout Pages')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->url(fn (): string => route('admin.widgets')),
                NavigationItem::make('Default pages')
                    ->group('Admin Layout Pages')
                    ->icon('heroicon-o-squares-2x2')
                    ->url(fn (): string => route('admin.dafault-pages')),
                NavigationItem::make('Services')
                    ->group('Admin Layout Pages')
                    ->icon('heroicon-o-cube')
                    ->url(fn (): string => route('admin.services')),
                NavigationItem::make('Products')
                    ->group('Admin Layout Pages')
                    ->icon('heroicon-o-globe-alt')
                    ->url(fn (): string => route('admin.products')),
                NavigationItem::make('Top bar settings')
                    ->group('Header')
                    ->icon('heroicon-o-arrow-up')
                    ->url(fn (): string => route('admin.top-bar-settings')),
                NavigationItem::make('Top menu settings')
                    ->group('Header')
                    ->icon('heroicon-o-list-bullet')
                    ->url(fn (): string => route('admin.top-menu')),
                NavigationItem::make('Banners')
                    ->group('Blog sidebar')
                    ->icon('heroicon-o-megaphone')
                    ->url(fn (): string => route('admin.posts-banners')),
                NavigationItem::make('Useful Links')
                    ->group('Footer')
                    ->icon('heroicon-o-link')
                    ->url(fn (): string => route('admin.useful-link-list')),
                NavigationItem::make('About US icons')
                    ->group('Footer')
                    ->icon('heroicon-o-sparkles')
                    ->url(fn (): string => route('admin.widget-icons', 34).'?page=4'),
                NavigationItem::make('Bottom bar settings')
                    ->group('Footer')
                    ->icon('heroicon-o-arrow-down')
                    ->url(fn (): string => route('admin.bottom-bar-settings')),
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                ControlOverview::class,
                AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
