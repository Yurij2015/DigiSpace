<?php

namespace App\Services;

use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Database\Eloquent\Collection;

class PagesService
{
    public function filteredMenuItems($menuItems): Collection
    {
        $excluledPages = ['about', 'services', 'pricing', 'promos', 'blog', 'pages', 'contact-us'];
        return $menuItems->reject(function (MenuItem|Page $value) use ($excluledPages) {
            return in_array($value->slug, $excluledPages, true);
        });
    }
}
