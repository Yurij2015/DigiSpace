<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterBottomBarContent;
use Inertia\Inertia;
use Inertia\Response;

class FooterBottomBarContentController extends Controller
{
    public function index(): Response
    {
        $footerBottomBarContent = FooterBottomBarContent::all()->first();
        return Inertia::render(
            'Admin/FooterBottomBarSettings/Index',
            ['footerBottomBarContent' => $footerBottomBarContent]
        );
    }
}
