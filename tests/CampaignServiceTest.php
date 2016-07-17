<?php

namespace Klaviyo\Tests;

use Klaviyo\KlaviyoApi;
use Klaviyo\TrackService;
use Klaviyo\Model\PersonModel;
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
    'list_id' => 'erRoOX',
    'template' => [
      'object' => 'email-template',
      'id' => 'fsSpPY',
      'html' => '<html><body><p>This is the email content</p></body></html>',
    ],
    'status' => 'draft',
    'sent_at' => null,
    'created' => '2103-06-14 12:00:00'
  ];

  public function testGetPerson() {
    /*
    $container = $responses = [];
    $responses[] = new Response(200, [], '1');
    $client = $this->getClient($container, $responses);

    $api = new KlaviyoApi($client, $this->apiKey);
    $campaign = new CampaignService($api);
    */
  }

}
