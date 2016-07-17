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
