<?php

namespace App\Repositories;

use DB;
use Illuminate\Support\Collection;

class BlogRepository
{
    public function getGroupedPosts(): Collection
    {
        return DB::table('posts')
            ->select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month, MONTHNAME(created_at) as month_name, count(*) as post_count'))
            ->groupBy('year', 'month', 'month_name')->orderBy('year', 'asc')
            ->orderBy('month', 'asc')->get();
    }

    public function getArchivedPosts(int $year, int $month): Collection
    {
        return DB::table('posts')
            ->select(DB::raw("*, CONCAT('uploads/', img_path) as img_path"))
            ->whereRaw("YEAR(created_at) = $year AND MONTH(created_at) = $month")
            ->get();
    }
}
