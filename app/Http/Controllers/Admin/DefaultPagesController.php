<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DefaultPagesController extends Controller
{
    public function index(): Response
    {
//        dd($this->getPageData("promos")->widgets->count());
        return Inertia::render('Admin/DefaultPages/Index', [
            'defaultPages' => [
                "about" => ['count' => $this->getPageData("about")->widgets->count()],
                "services" => ['count' => $this->getPageData("services")->widgets->count()],
                "pricing" => ['count' => $this->getPageData("pricing")->widgets->count()],
                "promos" => ['count' => $this->getPageData("promos")->widgets->count()],
            ],
        ]);
    }


    private function getPageData($slug)
    {
        return Page::with(['widgets'])->where('slug', '=', $slug)->first();
    }

}
