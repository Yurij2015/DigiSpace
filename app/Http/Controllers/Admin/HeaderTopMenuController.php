<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Inertia\Inertia;
use Inertia\Response;

class HeaderTopMenuController extends Controller
{
    public function index(): Response
    {
        $menu = Menu::with('menuItem')->get();
        return Inertia::render(
            'Admin/PublicMenu/Index',
            ['menu' => $menu]
        );
    }

    public function editForm(Menu $menuItem): Response
    {
        return Inertia::render(
            'Admin/PublicMenu/MenuItemEdit',
            ['menuItem' => $menuItem]
        );
    }
}
