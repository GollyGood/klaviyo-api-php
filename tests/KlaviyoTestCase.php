<?php

namespace Klaviyo\Tests;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use Http\Factory\Guzzle\RequestFactory;
use Http\Factory\Guzzle\StreamFactory;
use Klaviyo\KlaviyoApi;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client as GuzzleClient;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;

class KlaviyoTestCase extends TestCase
{
    protected $apiKey = 'asdf';
    public $endPoint = 'https://a.klaviyo.com';

    protected function getClient(&$container, $responses = array())
    {
        if (empty($responses)) {
            $responses = [new Response(200)];
        }

        $history = Middleware::history($container);
        $mock = new MockHandler($responses);
        $handlerStack = HandlerStack::create($mock);
        $handlerStack->push($history);

        return new GuzzleAdapter(new GuzzleClient(['handler' => $handlerStack]));
    }

    public function getApi($apiKey = '', $options = [], &$container = [], $responses = array())
    {
        if (empty($apiKey)) {
          $apiKey = $this->apiKey;
        }

        return new KlaviyoApi($this->getClient($container, $responses), new RequestFactory(), new StreamFactory(), $apiKey, $options);
    }
}
