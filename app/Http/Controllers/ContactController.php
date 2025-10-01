<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormSaveRequest;
use App\Models\ContactForm;
use App\Models\Page;
use App\Rules\RecaptchaRule;
use com\zoho\crm\api\HeaderMap;
use com\zoho\crm\api\record\ActionWrapper;
use com\zoho\crm\api\record\APIException;
use com\zoho\crm\api\record\BodyWrapper;
use com\zoho\crm\api\record\Leads;
use com\zoho\crm\api\record\Record;
use com\zoho\crm\api\record\SuccessResponse;
use com\zoho\crm\api\util\Choice;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\api\authenticator\store\FileStore;
use com\zoho\api\logger\Levels;
use com\zoho\api\logger\LogBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\exception\SDKException;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\record\GetRecordsParam;
use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\record\RecordOperations;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public const GET_IN_TOUCH = 15;

    public const PAGE = 'contact-us';

    /**
     * @throws SDKException
     */
    public static function zohoInitializer(): void
    {
        $logger = (new LogBuilder())
            ->level(Levels::INFO)
            ->filePath("../php_sdk_log.log")
            ->build();

        $environment = USDataCenter::PRODUCTION();

        $token = (new OAuthBuilder())
            ->clientID(config('services.zoho.client_id'))
            ->clientSecret(config('services.zoho.client_secret'))
            ->grantToken(config('services.zoho.grant_token'))
            ->findUser(false)
            ->build();

        $tokenStore = new FileStore("../zohoStore.txt");

        (new InitializeBuilder())
            ->environment($environment)
            ->token($token)
            ->store($tokenStore)
            ->logger($logger)
            ->initialize();
    }

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
            }
        ])->where('slug', '=', self::PAGE)->first();
    }

    /**
     * @throws SDKException
     */
    public function save(ContactFormSaveRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['name'] = $validated['first_name'] . ' ' . $validated['last_name'];

        ContactForm::create($validated);

        $this->sentLeadToZoho($validated);

        return back()->with('success', 'We have received your message and would like to thank you for writing to us!');
    }

    /**
     * @throws SDKException
     */
    private function sentLeadToZoho(array $leadData): void
    {
        self::zohoInitializer();

        $moduleAPIName = 'leads';
        $recordOperations = new RecordOperations($moduleAPIName);
        $bodyWrapper = new BodyWrapper();
        $records = array();
        $lead = new Record();
        $lead->addFieldValue(Leads::FirstName(), $leadData['first_name']);
        $lead->addFieldValue(Leads::LastName(), $leadData['last_name']);
        $lead->addFieldValue(Leads::Email(), $leadData['email']);
        $lead->addFieldValue(Leads::Phone(), $leadData['phone']);
        $lead->addFieldValue(Leads::Description(), $leadData['message']);
        $lead->addFieldValue(Leads::LeadSource(), new Choice('Online Store'));
        $records[] = $lead;
        $bodyWrapper->setData($records);
        $headerInstance = new HeaderMap();
        $response = $recordOperations->createRecords($bodyWrapper, $headerInstance);

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
