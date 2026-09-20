<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class NotFoundController extends Controller
{
    public function index(): Response
    {
        return response()->view('errors.page-not-found', status: 404);
    }
}
