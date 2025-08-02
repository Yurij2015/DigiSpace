<?php

namespace App\Services;

use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PagesService
{
    public function filteredPages($excluledPages, $count): LengthAwarePaginator
    {
        return Page::with('menuItem')->whereNotIn('slug', $excluledPages)
            ->orderBy('created_at', 'desc')->paginate($count);
    }

    public function filteredMenuItems($excluledItems): array|Collection
    {
        return MenuItem::whereNotIn('slug', $excluledItems)->orderBy('created_at', 'desc')->get();
    }
}
