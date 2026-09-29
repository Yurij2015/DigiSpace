<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormSaveRequest;
use App\Models\ContactForm;
use App\Models\Page;
use App\Services\ZohoLeadService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Throwable;

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
        return Page::with([
            'widgets' => function (BelongsToMany $query) use ($widgetCategory) {
                $query->where('widget_category_id', '=', $widgetCategory);
            },
        ])->where('slug', '=', self::PAGE)->first();
    }

    public function save(ContactFormSaveRequest $request, ZohoLeadService $zohoLeads): RedirectResponse|JsonResponse
    {
        $validated = $request->validated();
        $validated['name'] = $validated['first_name'].' '.$validated['last_name'];
        $validated['source'] = ContactForm::SOURCE_CONTACT_PAGE;

        ContactForm::create($validated);

        try {
            $zohoLeads->sendLead($validated);
        } catch (Throwable $exception) {
            report($exception);
        }

        if ($request->expectsJson()) {
            return response()->json(['message' => __('site.contact_success')]);
        }

        return back()->with('success', __('site.contact_success'));
    }
}
