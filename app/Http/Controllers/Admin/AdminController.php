<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Ticket;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    public function tickets(): Response
    {
        return Inertia::render('Admin/Tickets', [
            'tickets' => Ticket::with('user:id,name')->latest()->get(),
        ]);
    }

    public function categories(): Response
    {
        return Inertia::render('Admin/Categories', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function categoryStore(Request $request): Application|RedirectResponse|Redirector
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' =>'required|string|max:255'
        ]);

        $request->user()->categories()->create($validated);


        return redirect(route('admin.categories'));

    }

}