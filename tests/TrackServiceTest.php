<?php

namespace Klaviyo\Tests;

use GuzzleHttp\Psr7\Response;
use Klaviyo\KlaviyoApi;
use Klaviyo\Model\PersonModel;
use Klaviyo\TrackService;

class TrackServiceTest extends KlaviyoTestCase
{
    protected $personConfiguration = [
        '$email' => 'john.smith@example.com',
        '$first_name' => 'John',
        '$last_name' => 'Smith',
        '$phone_number' => '1-617-555-1234',
        '$title' => 'Owner',
        '$organization' => 'Big Box Company',
        'Custom' => null,
    ];

    public function getTrackService(&$container, $responses)
    {
        $api = $this->getApi($this->apiKey, [], $container, $responses);
        return new TrackService($api);
    }

    public function testGetPerson()
    {
        $container = $responses = [];
        $responses[] = new Response(200, [], '1');
        $track_manager = $this->getTrackService($container, $responses);
        $person = PersonModel::create($this->personConfiguration);
        $this->assertTrue($track_manager->identify($person));

        $request = $container[0]['request'];
        $this->assertEquals('GET', $request->getMethod());

        $options = http_build_query(['data' => base64_encode(json_encode(['token' => $this->apiKey, 'properties' => $person]))]);
        $this->assertSame($options, $request->getUri()->getQuery());
    }
}
