<?php

namespace Klaviyo\Tests;

use GuzzleHttp\Psr7\Response;
use Http\Factory\Guzzle\RequestFactory;
use Http\Factory\Guzzle\StreamFactory;
use Klaviyo\CampaignService;
use Klaviyo\KlaviyoApi;
use Klaviyo\Model\CampaignModel;
use Klaviyo\Model\ListModel;
use Klaviyo\Model\TemplateModel;
use Klaviyo\Model\ObjectId;

class CampaignServiceTest extends KlaviyoTestCase
{
    protected $campaignResponse = [
        'object' => 'campaign',
        'id' => 'dqQnNW',
        'name' => 'Campaign Name',
        'subject' => 'Company Monthly Newsletter',
        'from_email' => 'george.washington@example.com',
        'from_name' => 'George Washington',
        'lists' => [
            [
                'object' => 'list',
                'id' => 'dqQnNW',
                'name' => 'Fancy List',
                'list_type' => 'list',
                'created' => '2013-06-14 12:00:00',
                'updated' => '2013-06-14 12:00:00',
                'person_count' => 5,
                'folder' => null,
            ],
        ],
        'template' => [
            'object' => 'email-template',
            'id' => 'fsSpPY',
            'html' => '<html><body><p>This is the email content</p></body></html>',
        ],
        'status' => 'draft',
        'status_id' => 2,
        'status_label' => 'Draft',
        'sent_at' => null,
        'send_time' => '',
        'created' => '2013-06-14 12:00:00',
        'updated' => '2013-06-14 12:00:00',
        'num_recipients' => 0,
        'is_segmented' => false,
        'campaign_type' => 'Regular',
    ];

    protected $campaignConfiguration = [
        'list_id' => 'dqQnNW',
        'template_id' => 'fsSpPY',
        'from_email' => 'george.washington@example.com',
        'from_name' => 'George Washington',
        'subject' => 'Company Monthly Newsletter',
        'name' => 'Campaign Name',
        'use_smart_sending' => true,
        'add_google_analytics' => false,
    ];

    public function setUp()
    {
        $this->responseCampaignZero = [
            'object' => 'campaign',
            'id' => 'dqQnNW',
            'name' => 'Campaign Name',
            'subject' => 'Company Monthly Newsletter',
            'from_email' => 'george.washington@example.com',
            'from_name' => 'George Washington',
            'lists' => [
                [
                    'object' => 'list',
                    'id' => 'dqQnNW',
                    'name' => 'Fancy List',
                    'list_type' => 'list',
                    'created' => '2013-06-14 12:00:00',
                    'updated' => '2013-06-14 12:00:00',
                    'person_count' => 5,
                    'folder' => null,
                ],
            ],
            'template' => [
                'object' => 'email-template',
                'id' => 'fsSpPY',
                'html' => '<html><body><p>This is the email content</p></body></html>',
            ],
            'status' => 'sent',
            'sent_at' => '2103-06-17 14:30:00',
            'created' => '2103-06-14 12:00:00'
        ];

        $this->responseCampaignOne = [
            'object' => 'campaign',
            'id' => 'dqQnNW',
            'name' => 'Another Campaign Name',
            'subject' => 'Another Company Monthly Newsletter',
            'from_email' => 'Thomas.Jefferson@example.com',
            'from_name' => 'Thomas Jefferson',
            'lists' => [
                [
                    'object' => 'list',
                    'id' => 'dqQnNW',
                    'name' => 'Fancy List',
                    'list_type' => 'list',
                    'created' => '2013-06-14 12:00:00',
                    'updated' => '2013-06-14 12:00:00',
                    'person_count' => 5,
                    'folder' => null,
                ],
            ],
            'template' => [
                'object' => 'email-template',
                'id' => 'fsSpPY',
                'html' => '<html><body><p>This is the email content</p></body></html>',
            ],
            'status' => 'sent',
            'sent_at' => '2103-06-17 14:30:00',
            'created' => '2103-06-14 12:00:00'
        ];

        $this->responsePageZero = [
            'object' => '$list',
            'start' => 0,
            'end' => 1,
            'page_size' => 2,
            'total' => 4,
            'page' => 0,
            'data' => [
                $this->responseCampaignZero,
                $this->responseCampaignOne,
            ],
        ];
        $this->responsePageOne = $this->responsePageZero;
        $this->responsePageOne['start'] = 2;
        $this->responsePageOne['end'] = 3;
        $this->responsePageOne['page'] = 1;

    }

    public function getCampaignService(&$container, $responses)
    {
        $client = $this->getClient($container, $responses);

        $api = new KlaviyoApi($client, new RequestFactory(), new StreamFactory(), $this->apiKey);
        return new CampaignService($api);
    }

    public function getMultiPageCampaignService()
    {
        $container = $responses = [];
        $responses[] = new Response(200, [], json_encode($this->responsePageZero));
        $responses[] = new Response(200, [], json_encode($this->responsePageOne));

        return $this->getCampaignService($container, $responses);
    }

    public function testGetCampaign()
    {
        $container = $responses = [];
        $responses[] = new Response(200, [], json_encode($this->campaignResponse));
        $campaign_service = $this->getCampaignService($container, $responses);

        $campaign = $campaign_service->getCampaign(new ObjectId('dqQnNW'));
        $campaign_response = CampaignModel::create($this->campaignResponse);
        $this->assertEquals($campaign_response, $campaign);
    }

    public function testGetAllCampaigns()
    {
        $campaign_manager = $this->getMultiPageCampaignService();
        $campaigns = $campaign_manager->getAllCampaigns();

        $this->assertCount(4, $campaigns);

        /*
        $listZero = new ListModel($this->responsePageZero['data'][0]);
        $this->assertEquals($listZero, $lists[0]);
        $listOne = new ListModel($this->responsePageZero['data'][1]);
        $this->assertEquals($listOne, $lists[1]);
        $listTwo = new ListModel($this->responsePageOne['data'][0]);
        $this->assertEquals($listTwo, $lists[2]);
        $listThree = new ListModel($this->responsePageOne['data'][1]);
        $this->assertEquals($listThree, $lists[3]);
         */
    }

    public function testCreateCampaign()
    {
        $container = $responses = [];
        $responses[] = new Response(200, [], json_encode($this->campaignResponse));

        $campaign_response = $this->campaignResponse;
        $campaign_response['template'] = TemplateModel::create($campaign_response['template']);
        $campaign_response['lists'][0] = ListModel::create($campaign_response['lists'][0]);
        $campaign_response = CampaignModel::create($campaign_response);

        $campaign_service = $this->getCampaignService($container, $responses);
        $this->assertEquals($campaign_response, $campaign_service->createCampaign($this->campaignConfiguration));
    }

    public function testSendCampaignImmediately()
    {
        $container = $responses = [];
        $responses[] = new Response(200, [], json_encode(['status' => 'queued']));
        $campaign_service = $this->getCampaignService($container, $responses);
        $this->assertSame(['status' => 'queued'], $campaign_service->sendCampaignImmediately('dqQnNW'));
    }

    public function testScheduleCampaign()
    {
        $container = $responses = [];
        $responses[] = new Response(200, [], json_encode(['status' => 'queued']));
        $campaign_service = $this->getCampaignService($container, $responses);

        $send_time = new \DateTime();
        $this->assertSame(['status' => 'queued'], $campaign_service->scheduleCampaign('dqQnNW', $send_time));
    }
}
