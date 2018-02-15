<?php

namespace Klaviyo;

/**
 * The base manager class used handle models transmission to and from the API.
 */
class BaseService implements ServiceInterface
{
    /**
     * The Klavioyo api service.
     *
     * @var KlaviyoApi
     */
    protected $api;

    /**
     * The resource prefix to apply to the resource path.
     */
    protected $resourcePrefix = '/api/v1/';

    /**
     * The constructor for the list manager class.
     *
     * @param KlaviyoApi $api
     *   The Klaviyo API object to use for communicating with the Klaviyo API.
     */
    public function __construct(KlaviyoApi $api)
    {
        $this->api = $api;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(KlaviyoApi $api): ServiceInterface
    {
        return new static($api);
    }

    /**
     * Retrieve the full resource path.
     *
     * @return string
     *   The full resource path incuding the resource prefix and resource path.
     *   Example: /api/v1/lists
     */
    public function getResourcePath(string $resource): string
    {
        return $this->resourcePrefix . $resource;
    }
}
