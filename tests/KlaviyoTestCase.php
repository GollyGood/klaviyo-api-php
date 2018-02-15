<?php

namespace Klaviyo\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use Http\Factory\Guzzle\RequestFactory;
use Http\Factory\Guzzle\StreamFactory;
use Klaviyo\KlaviyoApi;
use PHPUnit\Framework\TestCase;

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
        return new GuzzleHttpClient(new Client(['handler' => $handlerStack]));
    }
    public function getApi(?string $apiKey, array $options = [], &$container = [], $responses = array())
    {
        return new KlaviyoApi($this->getClient($container, $responses), new RequestFactory(), new StreamFactory(), $apiKey ?? $this->apiKey, $options);
    }
}
