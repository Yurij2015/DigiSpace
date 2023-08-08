<?php

namespace App\Services;

use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
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
