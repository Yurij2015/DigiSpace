<?php

namespace App\Services;

use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Collection;

class PagesService
{
    public function filteredMenuItems($menuItems): Collection
    {
        $excluledPages = ['about', 'services', 'pricing', 'promos', 'blog', 'pages', 'contact-us'];
        return $menuItems->filter(function (MenuItem $value) use ($excluledPages) {
            return !in_array($value->slug, $excluledPages, true);
        });
    }
}
