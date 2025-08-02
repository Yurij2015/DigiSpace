<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function save(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'email' => 'required|email|unique:subscribers',
        ]);
        Subscriber::create($request->all());

        return back()->with('success', 'You are successfully subscribed!');
    }
}
