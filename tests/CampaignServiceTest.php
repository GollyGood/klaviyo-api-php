<?php

namespace Klaviyo\Tests;

use GuzzleHttp\Psr7\Response;
use Klaviyo\CampaignService;
use Klaviyo\KlaviyoApi;
use Klaviyo\Model\CampaignModel;
use Klaviyo\Model\ListModel;
use Klaviyo\Model\TemplateModel;

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

    public function getCampaignService(&$container, $responses)
    {
        $client = $this->getClient($container, $responses);

        $api = new KlaviyoApi($client, $this->apiKey);
        return new CampaignService($api);
    }

    public function testGetCampaign()
    {
        $container = $responses = [];
        $responses[] = new Response(200, [], json_encode($this->campaignResponse));
        $campaign_service = $this->getCampaignService($container, $responses);

        $campaign = $campaign_service->getCampaign('dqQnNW');
        $campaign_response = CampaignModel::create($this->campaignResponse);
        $this->assertEquals($campaign_response, $campaign);
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
