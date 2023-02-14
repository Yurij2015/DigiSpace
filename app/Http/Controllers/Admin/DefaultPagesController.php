<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Services\DefaultPageService;
use Inertia\Inertia;
use Inertia\Response;

class DefaultPagesController extends Controller
{
    public function index(DefaultPageService $page): Response
    {
        return Inertia::render('Admin/DefaultPages/Index', [
            'defaultPages' => [
                "about" => ['page' => $page->getPageData("about")],
                "services" => ['page' => $page->getPageData("services")],
                "pricing" => ['page' => $page->getPageData("pricing")],
                "promos" => ['page' => $page->getPageData("promos")],
                "contact-us" => ['page' => $page->getPageData("contact-us")],
            ],
        ]);
    }


    public function show(Page $page): Response
    {
        return Inertia::render('Admin/DefaultPages/Show', [
            'page' => $page->widgets,
        ]);
    }

}
