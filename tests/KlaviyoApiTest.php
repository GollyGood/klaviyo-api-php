<?php

namespace Klaviyo\Tests;

use Klaviyo\KlaviyoApi;
use Psr\Http\Message\ResponseInterface;

class KlaviyoApiTest extends KlaviyoTestCase {

  /**
   * @expectedException Klaviyo\Exception\ApiException
   */
  public function testExceptionSetApiKey() {
    $api = KlaviyoApi::create();
  }

  public function testCanGetApiEndpoint() {
    $this->assertSame($this->endPoint, KlaviyoApi::$endPoint, 'The endpoint was not set or retrievable as expected.');
  }

  public function testRequestWithEndPointAndApiKey() {
    $container = [];
    $client = $this->getClient($container);

    $api = new KlaviyoApi($client, 'thisisakey');
    $response = $api->request('GET', 'api/v1');

    $request = $container[0]['request'];
    $this->assertSame('GET', $request->getMethod(), 'The request did not use GET.');
    $this->assertSame($this->endPoint . '/api/v1?api_key=thisisakey', (string) $request->getUri(), 'The request created the wrong Uri.');
    $this->assertInstanceOf(ResponseInterface::Class, $response, 'A Response object was not returned.');
  }


}
