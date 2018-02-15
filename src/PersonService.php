<?php

namespace Klaviyo;

use Klaviyo\Model\PersonModel;

/**
 * The list manager class used to handle lists.
 */
class PersonService extends BaseService
{

    /**
     * Retrieve a person from the Klaviyo API.
     *
     * @param string $id
     *   The id of the person that should be retrieved.
     *
     * @return PersonModel
     *   The person model object if it exists in Klaviyo.
     */
    public function getPerson($id)
    {
        $response = $this->api->request('GET', $this->getResourcePath("person/$id"));
        return PersonModel::createFromJson($response->getBody());
    }
}
