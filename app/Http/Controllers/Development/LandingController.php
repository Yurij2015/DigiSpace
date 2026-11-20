<?php

namespace App\Http\Controllers\Development;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaasInquirySaveRequest;
use App\Models\ContactForm;
use App\Services\ZohoLeadService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Throwable;

/**
 * Development landings that share one template (development/landing.blade.php) and differ in copy:
 * /development/saas speaks to technical founders, /development/business to business owners.
 */
class LandingController extends Controller
{
    /**
     * @var array<string, array{route: string, source: string, lead_label: string}>
     */
    public const LANDINGS = [
        'saas' => [
            'route' => 'development.saas',
            'source' => ContactForm::SOURCE_SAAS_LANDING,
            'lead_label' => '(SaaS Inquiry)',
        ],
        'business' => [
            'route' => 'development.business',
            'source' => ContactForm::SOURCE_BUSINESS_LANDING,
            'lead_label' => '(Business Inquiry)',
        ],
        'laravel' => [
            'route' => 'development.laravel',
            'source' => ContactForm::SOURCE_LARAVEL_LANDING,
            'lead_label' => '(Laravel Inquiry)',
        ],
        'symfony' => [
            'route' => 'development.symfony',
            'source' => ContactForm::SOURCE_SYMFONY_LANDING,
            'lead_label' => '(Symfony Inquiry)',
        ],
        'api-integrations' => [
            'route' => 'development.api-integrations',
            'source' => ContactForm::SOURCE_API_INTEGRATIONS_LANDING,
            'lead_label' => '(API Integrations Inquiry)',
        ],
        'php-support' => [
            'route' => 'development.php-support',
            'source' => ContactForm::SOURCE_PHP_SUPPORT_LANDING,
            'lead_label' => '(PHP Support Inquiry)',
        ],
        'php-audit' => [
            'route' => 'development.php-audit',
            'source' => ContactForm::SOURCE_PHP_AUDIT_LANDING,
            'lead_label' => '(PHP Audit Inquiry)',
        ],
    ];

    /**
     * Display the directory of development landing pages.
     */
    public function index(): View
    {
        return view('development.index', [
            'landings' => array_keys(self::LANDINGS),
        ]);
    }

    /**
     * Display the SaaS MVP development landing page.
     */
    public function show(): View
    {
        return $this->render('saas');
    }

    /**
     * Display the custom software landing page for business owners.
     */
    public function business(): View
    {
        return $this->render('business');
    }

    public function laravel(): View
    {
        return $this->render('laravel');
    }

    public function symfony(): View
    {
        return $this->render('symfony');
    }

    public function apiIntegrations(): View
    {
        return $this->render('api-integrations');
    }

    public function phpSupport(): View
    {
        return $this->render('php-support');
    }

    public function phpAudit(): View
    {
        return $this->render('php-audit');
    }

    /**
     * Store an inquiry from the SaaS landing and push it to Zoho CRM as a lead.
     */
    public function inquiry(SaasInquirySaveRequest $request, ZohoLeadService $zohoLeads): RedirectResponse
    {
        return $this->storeInquiry('saas', $request, $zohoLeads);
    }

    /**
     * Store an inquiry from the business landing and push it to Zoho CRM as a lead.
     */
    public function businessInquiry(SaasInquirySaveRequest $request, ZohoLeadService $zohoLeads): RedirectResponse
    {
        return $this->storeInquiry('business', $request, $zohoLeads);
    }

    public function laravelInquiry(SaasInquirySaveRequest $request, ZohoLeadService $zohoLeads): RedirectResponse
    {
        return $this->storeInquiry('laravel', $request, $zohoLeads);
    }

    public function symfonyInquiry(SaasInquirySaveRequest $request, ZohoLeadService $zohoLeads): RedirectResponse
    {
        return $this->storeInquiry('symfony', $request, $zohoLeads);
    }

    public function apiIntegrationsInquiry(SaasInquirySaveRequest $request, ZohoLeadService $zohoLeads): RedirectResponse
    {
        return $this->storeInquiry('api-integrations', $request, $zohoLeads);
    }

    public function phpSupportInquiry(SaasInquirySaveRequest $request, ZohoLeadService $zohoLeads): RedirectResponse
    {
        return $this->storeInquiry('php-support', $request, $zohoLeads);
    }

    public function phpAuditInquiry(SaasInquirySaveRequest $request, ZohoLeadService $zohoLeads): RedirectResponse
    {
        return $this->storeInquiry('php-audit', $request, $zohoLeads);
    }

    private function render(string $copy): View
    {
        return view('development.landing', [
            'copy' => $copy,
            'landingRoute' => self::LANDINGS[$copy]['route'],
            'leadSource' => self::LANDINGS[$copy]['source'],
        ]);
    }

    private function storeInquiry(string $copy, SaasInquirySaveRequest $request, ZohoLeadService $zohoLeads): RedirectResponse
    {
        $validated = $request->validated();
        $source = self::LANDINGS[$copy]['source'];

        $contact = $validated['contact'];
        $isEmail = filter_var($contact, FILTER_VALIDATE_EMAIL) !== false;

        $details = [
            'Source: '.$source.' ('.app()->getLocale().')',
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
            'last_name' => self::LANDINGS[$copy]['lead_label'],
            // A Telegram handle is not a phone number, so non-email contacts live only in the message.
            'email' => $isEmail ? $contact : null,
            'phone' => null,
            'message' => implode("\n", $details),
            'source' => $source,
        ];

        ContactForm::create($lead);

        // The lead is already stored. A CRM failure (expired token, API outage) must not turn into an
        // error page: the visitor would think nothing was sent and submit again. Report it instead.
        try {
            $zohoLeads->sendLead($lead);
        } catch (Throwable $exception) {
            report($exception);
        }

        return back()->with('saas_success', true)->withFragment('contact');
    }
}
