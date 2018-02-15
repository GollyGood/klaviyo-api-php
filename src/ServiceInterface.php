<?php

namespace Klaviyo;

/**
 * The base manager class used handle models transmission to and from the API.
 */
interface ServiceInterface
{
    /**
     * Instantiates a new instance of this class.
     */
    public static function create(KlaviyoApi $api);

    /**
     * Retrieve the full resource path.
     *
     * @return string
     *   The full resource path incuding the resource prefix and resource path.
     *   Example: /api/v1/lists
     */
    public function getResourcePath($resource);
}
