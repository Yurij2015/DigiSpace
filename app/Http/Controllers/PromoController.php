<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;


class PromoController extends Controller
{
    public function index(): Application|Factory|View
    {
        return view('promo.index');
    }
}
