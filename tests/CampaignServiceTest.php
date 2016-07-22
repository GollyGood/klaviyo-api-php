<?php

namespace Klaviyo\Tests;

use Klaviyo\KlaviyoApi;
use Klaviyo\KlaviyoFacade;
use Klaviyo\CampaignService;
use Klaviyo\Model\CampaignModel;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

class CampaignServiceTest extends KlaviyoTestCase {

  protected $campaignResponse = [
    'object' => 'campaign',
    'id'=> 'dqQnNW',
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
    'sent_at' => NULL,
    'send_time' => '',
    'created' => '2013-06-14 12:00:00',
    'updated' => '2013-06-14 12:00:00',
    'num_recipients' => 0,
    'is_segmented' => false,
    'campaign_type' => 'Regular',
  ];

  public function testGetCampaign() {
    $container = $responses = [];
    $responses[] = new Response(200, [], json_encode($this->campaignResponse));
    $client = $this->getClient($container, $responses);

    $api = new KlaviyoApi($client, $this->apiKey);
    $campaign_service = new CampaignService($api);
    $campaign = $campaign_service->getCampaign('dqQnNW');
    $campaign_response = CampaignModel::create($this->campaignResponse);
    $this->assertEquals($campaign_response, $campaign);
  }

}
