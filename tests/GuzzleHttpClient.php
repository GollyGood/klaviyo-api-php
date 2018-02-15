<?php

namespace Klaviyo\Tests;

use Klaviyo\HttpClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GuzzleHttpClient implements HttpClientInterface
{
    protected $client;

    public function __construct(\GuzzleHttp\Client $client)
    {
        $this->client = $client;
    }

    public function fetch(RequestInterface $request): ResponseInterface
    {
        return $this->client->send($request);
    }
}
