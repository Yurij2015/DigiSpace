<?php

namespace App\Filament\Support;

use App\Models\Page;
use App\Models\Post;
use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Model;

/**
 * Header action on edit pages: open the record's public URL in the panel's current language.
 */
class ViewOnSiteAction
{
    public static function make(): Action
    {
        return Action::make('viewOnSite')
            ->label('View on site')
            ->icon(Heroicon::OutlinedArrowTopRightOnSquare)
            ->color('gray')
            ->url(fn (Model $record): ?string => self::publicUrl($record), shouldOpenInNewTab: true)
            ->disabled(fn (Model $record): bool => self::publicUrl($record) === null)
            ->tooltip(fn (Model $record): ?string => self::publicUrl($record) === null ? self::reason($record) : null);
    }

    public static function publicUrl(Model $record): ?string
    {
        $locale = app()->getLocale();

        return match (true) {
            $record instanceof Post => $record->status === 'published'
                ? route('blog.post', ['locale' => $locale, 'postSlug' => $record->getRawOriginal('slug')])
                : null,
            $record instanceof Page => $record->menuItem?->slug
                ? route('pages.page', ['locale' => $locale, 'slug' => $record->menuItem->slug])
                : null,
            default => null,
        };
    }

    private static function reason(Model $record): string
    {
        return match (true) {
            $record instanceof Post => 'Only published posts are visible on the site.',
            $record instanceof Page => 'Link the page to a menu item to give it a public URL.',
            default => 'No public URL.',
        };
    }
}
