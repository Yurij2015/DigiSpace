<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormSaveRequest;
use App\Models\ContactForm;
use App\Models\Page;
use App\Services\ZohoLeadService;
use com\zoho\crm\api\exception\SDKException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\RedirectResponse;

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

    /**
     * @throws SDKException
     */
    public function save(ContactFormSaveRequest $request, ZohoLeadService $zohoLeads): RedirectResponse
    {
        $validated = $request->validated();
        $validated['name'] = $validated['first_name'].' '.$validated['last_name'];

        ContactForm::create($validated);

        $zohoLeads->sendLead($validated);

        if ($response !== null) {
            if ($response->isExpected()) {
                $actionHandler = $response->getObject();
                if ($actionHandler instanceof ActionWrapper) {
                    $actionWrapper = $actionHandler;
                    $actionResponses = $actionWrapper->getData();
                    foreach ($actionResponses as $actionResponse) {
                        if ($actionResponse instanceof SuccessResponse) {
                            Log::info('Lead added to Zoho CRM, Lead data', $leadData);
                            $successResponse = $actionResponse;
                            Log::info(
                                'Lead added to Zoho CRM',
                                [
                                    'Message' => $successResponse->getMessage(
                                    ) instanceof Choice ? $successResponse->getMessage()->getValue(
                                    ) : $successResponse->getMessage()
                                ]
                            );
                        }
                        if ($actionResponse instanceof APIException) {
                            $exception = $actionResponse;
                            Log::error('1Failed to add lead to Zoho CRM, Lead data', $leadData);
                            Log::error('1Failed to add lead to Zoho CRM', [
                                'Status' => $exception->getStatus()->getValue(),
                                'Code' => $exception->getCode()->getValue(),
                                'Details' => $exception->getDetails(),
                                'Message' => ($exception->getMessage() instanceof Choice ? $exception->getMessage(
                                )->getValue() : $exception->getMessage())
                            ]);
                        }
                    }
                }
                if ($actionHandler instanceof APIException) {
                    $exception = $actionHandler;
                    Log::error('2Failed to add lead to Zoho CRM, Lead data', $leadData);
                    Log::error('2Failed to add lead to Zoho CRM', [
                        'Status' => $exception->getStatus()->getValue(),
                        'Code' => $exception->getCode()->getValue(),
                        'Details' => $exception->getDetails(),
                        'Message' => ($exception->getMessage() instanceof Choice ? $exception->getMessage()->getValue(
                        ) : $exception->getMessage())
                    ]);
                }
            } else {
                Log::info('UnExpected response received from Zoho CRM');
            }
        }
    }

    /**
     * @throws SDKException
     */
    private function getLeadsData()
    {
        self::zohoInitializer();

        $leads = new RecordOperations('leads');
        $paramInstance = new ParameterMap();
        $fieldNames = "Lead_Name,First_Name,Last_Name,Email,Phone,Description";

        /** @var object $fieldNames */
        $paramInstance->add(GetRecordsParam::fields(), $fieldNames);

        $response = $leads->getRecords($paramInstance);
        return $response->getObject()->getData();
    }
}
