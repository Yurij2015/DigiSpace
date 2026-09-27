<?php

namespace App\Http\Controllers\Development;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaasInquirySaveRequest;
use App\Models\ContactForm;
use App\Services\ZohoLeadService;
use com\zoho\crm\api\exception\SDKException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SaasController extends Controller
{
    /**
     * Display the SaaS MVP development landing page.
     */
    public function show(): View
    {
        return view('development.saas');
    }

    /**
     * Store the SaaS project inquiry and push it to Zoho CRM as a lead.
     *
     * @throws SDKException
     */
    public function inquiry(SaasInquirySaveRequest $request, ZohoLeadService $zohoLeads): RedirectResponse
    {
        $validated = $request->validated();

        $contact = $validated['contact'];
        $isEmail = filter_var($contact, FILTER_VALIDATE_EMAIL) !== false;

        $details = [
            'Source: '.ContactForm::SOURCE_SAAS_LANDING.' ('.app()->getLocale().')',
            'Name / company: '.$validated['project_name'],
            'Contact: '.$contact,
            'Stage: '.($validated['stage'] ?? 'not specified'),
            'Budget: '.($validated['budget'] ?? 'not specified'),
            '',
            'Description:',
            $validated['description'],
        ];

        $lead = [
            'name' => $validated['project_name'],
            'first_name' => $validated['project_name'],
            'last_name' => '(SaaS Inquiry)',
            // A Telegram handle is not a phone number, so non-email contacts live only in the message.
            'email' => $isEmail ? $contact : null,
            'phone' => null,
            'message' => implode("\n", $details),
            'source' => ContactForm::SOURCE_SAAS_LANDING,
        ];

        ContactForm::create($lead);

        $zohoLeads->sendLead($lead);

        return back()->with('saas_success', true)->withFragment('contact');
    }
}
