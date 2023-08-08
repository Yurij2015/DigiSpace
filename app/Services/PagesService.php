<?php

namespace App\Services;

use App\Models\Page;
use Illuminate\Pagination\LengthAwarePaginator;

class PagesService
{
    public function filteredMenuItems($excluledPages, $count): LengthAwarePaginator
    {
        return Page::with('menuItem')->whereNotIn('slug', $excluledPages)
            ->orderBy('created_at', 'desc')->paginate($count);
    }
}
