<?php

namespace Klaviyo;

use Klaviyo\Model\IdInterface;
use Klaviyo\Model\PersonIdInterface;
use Klaviyo\Model\PersonModel;

/**
 * The list manager class used to handle lists.
 */
class PersonService extends BaseService
{
    /**
     * Retrieve a person from the Klaviyo API.
     *
     * @param PersonIdInterface $id        The id of the person that should be retrieved.
     * @return PersonModel      The person model object if it exists in Klaviyo.
     *
     * @throws Exception\ApiConnectionException
     * @throws Exception\BadRequestApiException
     * @throws Exception\NotAuthorizedApiException
     * @throws Exception\NotFoundApiException
     * @throws Exception\ServerErrorApiException
     */
    public function getPerson(PersonIdInterface $id): PersonModel
    {
        $response = $this->api->request('GET', $this->getResourcePath("person/{$id->getId()}"));
        return PersonModel::createFromJson($response->getBody());
    }

    /**
     * Update a persons attributes in Klaviyo API.
     *
     * @param PersonIdInterface $id
     * @param array $context
     * @return Model\ModelInterface
     * @throws Exception\ApiConnectionException
     * @throws Exception\BadRequestApiException
     * @throws Exception\NotAuthorizedApiException
     * @throws Exception\NotFoundApiException
     * @throws Exception\ServerErrorApiException
     */
    public function updatePerson(PersonIdInterface $id, array $context): PersonModel
    {
        $response = $this->api->request(
            'PUT',
            $this->getResourcePath("person/{$id->getId()}"),
            $context
        );
        return PersonModel::createFromJson($response->getBody());
    }
}
