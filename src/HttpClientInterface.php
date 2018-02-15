<?php

namespace Klaviyo;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface HttpClientInterface
{
    public function fetch(RequestInterface $request): ResponseInterface;
}
