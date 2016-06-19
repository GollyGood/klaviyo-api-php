<?php

namespace Klaviyo\Tests;

use Klaviyo\KlaviyoApi;
use Klaviyo\TrackService;
use Klaviyo\Model\PersonModel;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

class TrackServiceTest extends KlaviyoTestCase {

  protected $personConfiguration = [
    '$email' => 'john.smith@example.com',
    '$first_name' => 'John',
    '$last_name' => 'Smith',
    '$phone_number' => '1-617-555-1234',
    '$title' => 'Owner',
    '$organization' => 'Big Box Compan',
  ];

  public function getTrackService(&$container, $responses) {
    $client = $this->getClient($container, $responses);
    $api = new KlaviyoApi($client, $this->apiKey);
    return new TrackService($api);
  }

  public function testGetPerson() {
    $container = $responses = [];
    $responses[] = new Response(200, [], '1');
    $track_manager = $this->getTrackService($container, $responses);
    $person = PersonModel::create($this->personConfiguration);
    $this->assertTrue($track_manager->identify($person));

    $request = $container[0]['request'];
    $this->assertEquals('GET', $request->getMethod());

    $options = http_build_query(['data' => urlencode(base64_encode(json_encode(['token' => $this->apiKey, 'properties' => $person])))]);
    $this->assertSame($options, $request->getUri()->getQuery());
  }

}
