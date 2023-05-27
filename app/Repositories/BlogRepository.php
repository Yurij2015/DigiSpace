<?php

namespace App\Repositories;

use App\Models\Post;
use DB;
use Illuminate\Support\Collection;

class BlogRepository
{
    public function getGroupedPosts(): Collection
    {
        return Post::selectRaw('YEAR(created_at) as year,
        MONTH(created_at) as month, MONTHNAME(created_at) as month_name, count(*) as post_count')
            ->groupBy('year', 'month', 'month_name')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
    }

    public function getArchivedPosts(int $year, int $month): Collection
    {
        return Post::whereRaw("YEAR(`posts`.`created_at`) = $year AND MONTH(`posts`.`created_at`) = $month")
            ->with('category')->get();
    }
}
