<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function save(Request $request): RedirectResponse
    {
        if ($request->filled('nickname')) {
            return back()->with('subscribe_success', __('site.subscribe_success'));
        }

        $validated = $request->validateWithBag('subscribe', [
            'email' => 'required|email|unique:subscribers',
        ]);

        Subscriber::create($validated);

        return back()->with('subscribe_success', __('site.subscribe_success'));
    }
}
