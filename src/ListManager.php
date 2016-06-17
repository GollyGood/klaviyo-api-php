<?php

namespace Klaviyo;

use Klaviyo\Model\ListModel;
use Klaviyo\Model\ModelFactory;

/**
 * The list manager class used to handle lists.
 */
class ListManager extends BaseManager {

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
  public function getList($id) {
    $response = $this->api->request('GET', $this->getResourcePath("list/$id"));
    return ListModel::createFromJson($response->getBody());
  }

  /**
   * Retrieve all lists from Klaviyo.
   *
   * @return array
   *   An array of ListModels that represent all lists in Klaviyo.
   */
  public function getAllLists() {
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
  public function getListsFromPage($page = 0, $count = 0) {
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
  public function createList($name, $type = 'list') {
    $options = ['name' => $name, 'list_type' => $type];
    $response = $this->api->request('POST', $this->getResourcePath('lists'), $options);
    return ListModel::createFromJson($response->getBody());
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
  public function updateList(ListModel $list) {
    $options = ['name' => $list->getName()];
    $response = $this->api->request('PUT', $this->getResourcePath("list/{$list->getId()}"), $options);
    return ListModel::createFromJson($response->getBody());
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
  public function deleteList(ListModel $list) {
    $response = $this->api->request('DELETE', $this->getResourcePath("list/{$list->getId()}"));
    return ListModel::createFromJson($response->getBody());
  }

  public function checkMembersAreInList(ListModel $list, $emails) {
    $options = ['query' => ['email' => implode(',', $emails) ]];
    $response = $this->api->request('GET', $this->getResourcePath("list/{$list->getId()}/members"), $options);
    $page = ModelFactory::create(json_decode($response->getBody(), TRUE), 'page');
    return array_map(ModelFactory::class . '::create', $page->getData());
  }

}
