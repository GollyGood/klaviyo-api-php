<?php

namespace Klaviyo;

/**
 * The base manager class used handle models transmission to and from the API.
 */
interface ServiceInterface
{
    /**
     * Instantiates a new instance of this class.
     * @param KlaviyoApi $api
     * @return ServiceInterface
     */
    public static function create(KlaviyoApi $api): ServiceInterface;

    /**
     * Retrieve the full resource path.
     *
     * @param string $resource
     * @return string
     *   The full resource path incuding the resource prefix and resource path.
     *   Example: /api/v1/lists
     */
    public function getResourcePath(string $resource): string;
}
