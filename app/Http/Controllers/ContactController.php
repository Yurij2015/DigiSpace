<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use App\Models\Page;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public const GET_IN_TOUCH = 15;

    public const PAGE = 'contact-us';

    public function index(): Application|Factory|View
    {
        $page = Page::where('slug', '=', self::PAGE)->first();
        $contactUs = $this->getContactUsPageComponent(self::GET_IN_TOUCH);

        return view('contact.index', ['page' => $page, 'contactUs' => $contactUs]);
    }

    private function getContactUsPageComponent($widgetCategory)
    {
        return Page::with(['widgets' => function (BelongsToMany $query) use ($widgetCategory) {
            $query->where('widget_category_id', '=', $widgetCategory);
        }])->where('slug', '=', self::PAGE)->first();
    }

    public function save(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'message' => 'required',
        ]);
        ContactForm::create($request->all());

        return back()->with('success', 'We have received your message and would like to thank you for writing to us!');
    }
}
