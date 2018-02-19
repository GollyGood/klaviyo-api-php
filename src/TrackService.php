<?php

namespace Klaviyo;

use Klaviyo\Model\EventModel;
use Klaviyo\Model\PersonModel;

/**
 * The track manager class used to handle lists.
 */
class TrackService extends BaseService
{

    protected $resourcePrefix = '/api/';

    /**
     * Identify a person to the Klaviyo API.
     *
     * @param PersonModel $person
     *   An instance of the person model that should be written.
     *
     * @return bool
     *
     * @throws Exception\ApiConnectionException
     * @throws Exception\BadRequestApiException
     * @throws Exception\NotAuthorizedApiException
     * @throws Exception\NotFoundApiException
     * @throws Exception\ServerErrorApiException
     */
    public function identify(PersonModel $person): bool
    {
        $options = ['query' => ['properties' => $person]];
        $response = $this->api->request('GET', $this->getResourcePath('identify'), $options, true);
        return (bool) $response->getBody()->getContents();
    }

    /**
     * Track an event in  Klaviyo API
     *
     * @param EventModel $event
     * @return bool
     * @throws Exception\ApiConnectionException
     * @throws Exception\BadRequestApiException
     * @throws Exception\NotAuthorizedApiException
     * @throws Exception\NotFoundApiException
     * @throws Exception\ServerErrorApiException
     */
    public function track(EventModel $event): bool
    {
        $options = ['query' => $event->toArray()];
        $response = $this->api->request('GET', $this->getResourcePath('track'), $options, true);
        return (bool) $response->getBody()->getContents();
    }
}
