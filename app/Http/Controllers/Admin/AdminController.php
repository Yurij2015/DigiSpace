<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    public function index(): Response
    {
        $ordersPerMonth = [
            [30, 78, 56, 34, 100, 45, 13],
            [27, 68, 86, 74, 10, 4, 87]
        ];
        return Inertia::render('Admin/Index', [
            'ordersPerMonth' => $ordersPerMonth,
            'profileImg' => "/img/team-2-800x800.jpg"
        ]);
    }
}
