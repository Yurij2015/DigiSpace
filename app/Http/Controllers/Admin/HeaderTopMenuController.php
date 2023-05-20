<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuSaveRequest as SaveRequest;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Http\RedirectResponse;
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

    final public function update(Menu $menu, SaveRequest $saveRequest): RedirectResponse
    {
        $menu->update($saveRequest->all());
        return redirect(route('admin.top-menu'))->with('message', 'Menu Updated Successfully');
    }


    public function subMenuEditForm(MenuItem $subMenuItem): Response
    {
        return Inertia::render(
            'Admin/PublicMenu/SubMenuItemEdit',
            ['subMenuItem' => $subMenuItem]
        );
    }

    final public function subMenuUpdate(MenuItem $subMenu, SaveRequest $saveRequest): RedirectResponse
    {
        $subMenu->update($saveRequest->all());
        return redirect(route('admin.top-menu'))->with('message', 'SubMenu Updated Successfully');
    }
}
