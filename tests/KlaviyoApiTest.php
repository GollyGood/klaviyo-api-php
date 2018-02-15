<?php

namespace Klaviyo\Tests;

use Klaviyo\KlaviyoApi;
use Psr\Http\Message\ResponseInterface;

class KlaviyoApiTest extends KlaviyoTestCase
{
    /**
     * @expectedException Klaviyo\Exception\ApiException
     */
    public function testExceptionSetApiKey()
    {
        $api = KlaviyoApi::create();
    }

    public function testCanGetApiEndpoint()
    {
        $this->assertSame($this->endPoint, KlaviyoApi::$endPoint, 'The API end point should be available.');
    }

    public function testRequestWithEndPointAndApiKey()
    {
        $container = [];
        $client = $this->getClient($container);

        $api = new KlaviyoApi($client, 'thisisakey');
        $response = $api->request('GET', 'api/v1');

        $request = $container[0]['request'];
        $this->assertSame('GET', $request->getMethod(), 'The request should had been GET.');
        $this->assertSame($this->endPoint . '/api/v1?api_key=thisisakey', (string) $request->getUri(), 'The request URI should include the resource and api key.');
        $this->assertInstanceOf(ResponseInterface::class, $response, 'The response should had been a Response object.');
    }

    public function testOptions()
    {
        $options = ['records_per_page' => 20];
        $api = KlaviyoApi::create('thisisakey', $options);
        $this->assertSame(20, $api->getOption('records_per_page'));
        $this->assertSame($options, $api->getAllOptions());
        $api->setOption('records_per_page', 1)->setOption('records_per_page', 5);
        $this->assertSame(5, $api->getOption('records_per_page'));
    }

    public function testDefaultOptions()
    {
        $api = KlaviyoApi::create('thisisakey');
        $this->assertSame(50, $api->getOption('records_per_page'));
    }
}
