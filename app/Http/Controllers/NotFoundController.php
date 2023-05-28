<?php

namespace App\Http\Controllers;

class NotFoundController extends Controller
{
    public function index()
    {
        return view('errors.page-not-found');
    }
}
