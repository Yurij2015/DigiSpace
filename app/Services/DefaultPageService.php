<?php

namespace App\Services;

use App\Models\Page;

class DefaultPageService
{
    public function getPageData($slug): ?object
    {
        return Page::with(['widgets'])->where('slug', '=', $slug)->first();
    }
}
