<?php

namespace Klaviyo;

use Klaviyo\Model\ListModel;
use Klaviyo\Model\ModelFactory;
use Klaviyo\Model\PersonModel;

/**
 * The list manager class used to handle lists.
 */
class ListService extends BaseService
{
    use PagerTrait;

    /**
     * Retrieve a specific list from Klaviyo.
     *
     * @param string $id
     *   The id for which to retrieve a list.
     *
     * @return ListModel
     *   The list object retrieved by the specified id.
     */
    public function getList($id)
    {
        $response = $this->api->request('GET', $this->getResourcePath("list/$id"));
        return ModelFactory::createFromJson($response->getBody()->getContents(), 'list');
    }

    /**
     * Retrieve all lists from Klaviyo.
     *
     * @return array
     *   An array of ListModels that represent all lists in Klaviyo.
     */
    public function getAllLists()
    {
        return $this->getAllRecords($this->getResourcePath('lists'));
    }

    /**
     * Get lists from a specific page.
     *
     * @param int $page
     *   The page number to retrieve.
     * @param int $count
     *   The number of items per page.
     *
     * @return array
     *   An array of records from the specified page.
     */
    public function getListsFromPage($page = 0, $count = 0)
    {
        return $this->getRecordsFromSpecificPage($this->getResourcePath('lists'), $page, $count);
    }

    /**
     * Create a new list.
     *
     * @param string $name
     *   The name of the list to be created.
     * @param string $type
     *   The type of list to be created.
     *
     * @return ListModel
     *   The list object created.
     */
    public function createList($name, $type = 'list')
    {
        $options = ['name' => $name, 'list_type' => $type];
        $response = $this->api->request('POST', $this->getResourcePath('lists'), $options);
        return ModelFactory::createFromJson($response->getBody()->getContents(), 'list');
    }

    /**
     * Update/Modify an existing list.
     *
     * @param ListModel $list
     *   The altered list object to update on Klaviyo.
     *
     * @return ListModel
     *   The updated list object.
     */
    public function updateList(ListModel $list)
    {
        $options = ['name' => $list->name];
        $response = $this->api->request('PUT', $this->getResourcePath("list/{$list->id}"), $options);
        return ModelFactory::createFromJson($response->getBody()->getContents(), 'list');
    }

    /**
     * Delete an existing list.
     *
     * @param ListModel $list
     *   The list object to be deleted.
     *
     * @return ListModel
     *   The deleted list object.
     */
    public function deleteList(ListModel $list)
    {
        $response = $this->api->request('DELETE', $this->getResourcePath("list/{$list->id}"));
        return ModelFactory::createFromJson($response->getBody()->getContents(), 'list');
    }

    /**
     * Check if the specified members are in the list by email address.
     *
     * @param ListModel $list
     *   The list for which to retrieve members.
     * @param array $emails
     *   The emails to check are associated with the specified list.
     *
     * @return array
     *    An array of MembershipModels associated with the specified list.
     */
    public function checkMembersAreInList(ListModel $list, $emails)
    {
        $options = ['query' => ['email' => implode(',', $emails)]];
        $response = $this->api->request('GET', $this->getResourcePath("$list->listType/{$list->id}/members"), $options);
        $page = ModelFactory::create(json_decode($response->getBody()->getContents(), true), 'page');
        return array_map(ModelFactory::class . '::create', $page->data);
    }

    /**
     * Check if the specified members are in the segment by email address.
     *
     * @see ListService::checkMembersAreInList()
     */
    public function checkMembersAreInSegment(ListModel $segment, $emails)
    {
        return $this->checkMembersAreInList($segment, $emails);
    }

    /**
     * Add a person to an existing List.
     *
     * @param ListModel $list
     *   The ListModel for which to add the person.
     * @param PersonModel $person
     *   The PersonModel of the person to add to a List.
     * @param bool $confirm_opt_in
     *   Default to TRUE. Determines if the person should be asked to confirm
     *   subscribing to list. When TRUE the person will recieve an email with a
     *   confirmation link before zhe is added to the list. Otherwise, when FALSE
     *   the person is automatically added to the list.
     *
     * @return PersonListModel
     *   The PersonList wrapper provided by the Klaviyo API.
     */
    public function addPersonToList(ListModel $list, PersonModel $person, $confirm_opt_in = true)
    {
        $options = [
            'email' => $person->email,
            'properties' => json_encode($person),
            'confirm_optin' => ($confirm_opt_in) ? 'true' : 'false',
        ];

        $response = $this->api->request('POST', $this->getResourcePath("list/{$list->id}/members"), $options);
        return ModelFactory::createFromJson($response->getBody()->getContents(), 'person_list');
    }
}
