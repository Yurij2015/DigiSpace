<?php

namespace App\Filament\Support;

use Filament\Navigation\NavigationGroup;

/**
 * The three sidebar groups of the control panel. Resources return ->label() from
 * getNavigationGroup(); the panel registers ->make() so labels match in every UI language.
 */
enum PanelNavigationGroup: string
{
    case Content = 'content';
    case Settings = 'settings';
    case Portfolio = 'portfolio';

    public function label(): string
    {
        return __('admin.navigation.'.$this->value);
    }

    public function make(): NavigationGroup
    {
        return NavigationGroup::make($this->label())
            ->collapsible()
            ->collapsed($this !== self::Content);
    }
}
