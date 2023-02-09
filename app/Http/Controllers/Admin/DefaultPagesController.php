<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DefaultPagesController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/DefaultPages/Index', [
            'defaultPages' => [
                "about",
                "services",
                "pricing",
                "promos",
                "contact-us"
            ],
        ]);
    }
}
