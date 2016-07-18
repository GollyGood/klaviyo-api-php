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
    'id' => 'dqqnnw',
    'name' => 'campaign name',
    'subject' => 'company monthly newsletter',
    'from_email' => 'george.washington@example.com',
    'from_name' => 'george washington',
    'list_id' => 'erroox',
    'template' => [
      'object' => 'email-template',
      'id' => 'fssppy',
      'html' => '<html><body><p>this is the email content</p></body></html>',
    ],
    'status' => 'draft',
    'sent_at' => Null,
    'created' => '2103-06-14 12:00:00'
  ];

  public function testGetCampaign() {
    /*
    $container = $responses = [];
    $responses[] = new Response(200, [], json_encode($this->campaignResponse));
    $client = $this->getClient($container, $responses);

    $api = new KlaviyoApi($client, $this->apiKey);
    $campaign_service = new CampaignService($api);
    $campaign = $campaign_service->getCampaign('dqQnNW');
    $campaign_response = CampaignModel::create($this->campaignResponse);
    $this->assertEquals($campaign_response, $campaign);
     */
    $api = KlaviyoFacade::create('pk_566b4bfbf328fdd0d5d462a54c211d3702');
    dump($api->service('campaign')->getCampaign('jWKCqU'));
  }

}
