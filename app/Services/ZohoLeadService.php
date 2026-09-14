<?php

namespace App\Services;

use com\zoho\api\authenticator\OAuthBuilder;
use com\zoho\api\authenticator\store\FileStore;
use com\zoho\api\logger\Levels;
use com\zoho\api\logger\LogBuilder;
use com\zoho\crm\api\dc\USDataCenter;
use com\zoho\crm\api\exception\SDKException;
use com\zoho\crm\api\HeaderMap;
use com\zoho\crm\api\InitializeBuilder;
use com\zoho\crm\api\ParameterMap;
use com\zoho\crm\api\record\ActionWrapper;
use com\zoho\crm\api\record\APIException;
use com\zoho\crm\api\record\BodyWrapper;
use com\zoho\crm\api\record\GetRecordsParam;
use com\zoho\crm\api\record\Leads;
use com\zoho\crm\api\record\Record;
use com\zoho\crm\api\record\RecordOperations;
use com\zoho\crm\api\record\SuccessResponse;
use com\zoho\crm\api\util\Choice;
use Illuminate\Support\Facades\Log;

/**
 * Pushes contact form submissions to Zoho CRM as Leads. Extracted from
 * ContactController so tests can bind a fake instead of hitting the SDK.
 */
class ZohoLeadService
{
    /**
     * @throws SDKException
     */
    public static function zohoInitializer(): void
    {
        $logger = (new LogBuilder)
            ->level(Levels::INFO)
            ->filePath('../php_sdk_log.log')
            ->build();

        $environment = USDataCenter::PRODUCTION();

        $token = (new OAuthBuilder)
            ->clientID(config('services.zoho.client_id'))
            ->clientSecret(config('services.zoho.client_secret'))
            ->grantToken(config('services.zoho.grant_token'))
            ->findUser(false)
            ->build();

        $tokenStore = new FileStore('../zohoStore.txt');

        (new InitializeBuilder)
            ->environment($environment)
            ->token($token)
            ->store($tokenStore)
            ->logger($logger)
            ->initialize();
    }

    /**
     * @throws SDKException
     */
    public function sendLead(array $leadData): void
    {
        self::zohoInitializer();

        $moduleAPIName = 'leads';
        $recordOperations = new RecordOperations($moduleAPIName);
        $bodyWrapper = new BodyWrapper;
        $records = [];
        $lead = new Record;
        $lead->addFieldValue(Leads::FirstName(), $leadData['first_name']);
        $lead->addFieldValue(Leads::LastName(), $leadData['last_name']);
        $lead->addFieldValue(Leads::Email(), $leadData['email']);
        $lead->addFieldValue(Leads::Phone(), $leadData['phone']);
        $lead->addFieldValue(Leads::Description(), $leadData['message']);
        $lead->addFieldValue(Leads::LeadSource(), new Choice('Online Store'));
        $records[] = $lead;
        $bodyWrapper->setData($records);
        $headerInstance = new HeaderMap;
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
                                    ) : $successResponse->getMessage(),
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
                                )->getValue() : $exception->getMessage()),
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
                        ) : $exception->getMessage()),
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
    public function getLeadsData()
    {
        self::zohoInitializer();

        $leads = new RecordOperations('leads');
        $paramInstance = new ParameterMap;
        $fieldNames = 'Lead_Name,First_Name,Last_Name,Email,Phone,Description';

        /** @var object $fieldNames */
        $paramInstance->add(GetRecordsParam::fields(), $fieldNames);

        $response = $leads->getRecords($paramInstance);

        return $response->getObject()->getData();
    }
}
