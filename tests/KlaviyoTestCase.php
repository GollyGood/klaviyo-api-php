<?php

namespace Klaviyo\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use Klaviyo\KlaviyoApi;

class KlaviyoTestCase extends \PHPUnit_Framework_TestCase
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
        return new Client(['handler' => $handlerStack, 'base_uri' => KlaviyoApi::$endPoint]);
    }
}
