<?php

namespace Klaviyo\Tests;

use GuzzleHttp\Psr7\Response;
use Klaviyo\KlaviyoApi;
use Klaviyo\Model\EventModel;
use Klaviyo\Model\PersonModel;
use Klaviyo\TrackService;
use Psr\Http\Message\RequestInterface;

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
    protected $eventConfiguration = [
        'event' => 'Elected President',
        'customer_properties' => [
            '$email' => 'thomas.jefferson@example.com'
        ],
        'properties' => [
            "PreviouslyVicePresident" => true,
            "YearElected" => 1801,
            "VicePresidents" => ["Aaron Burr", "George Clinton"]
        ],
        'time' => 1371477600,
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
        $trackService= $this->getTrackService($container, $responses);
        $person = PersonModel::create($this->personConfiguration);
        $this->assertTrue($trackService->identify($person));

        /** @var RequestInterface $request */
        $request = $container[0]['request'];
        $this->assertEquals('GET', $request->getMethod());

        $options = http_build_query(['data' => base64_encode(json_encode(['token' => $this->apiKey, 'properties' => $person]))]);
        $this->assertSame($options, $request->getUri()->getQuery());
    }

    public function testTrackEvent()
    {
        $container = $responses = [];
        $responses[] = new Response(200, [], '1');
        $trackService = $this->getTrackService($container, $responses);
        $event = EventModel::create($this->eventConfiguration);
        $this->assertTrue($trackService->track($event));

        /** @var RequestInterface $request */
        $request = $container[0]['request'];
        $this->assertEquals('GET', $request->getMethod());

        $options = http_build_query(['data' => base64_encode(json_encode(['token' => $this->apiKey] + $event->toArray()))]);
        $this->assertSame($options, $request->getUri()->getQuery());
    }
}
