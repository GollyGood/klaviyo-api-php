<?php

namespace Klaviyo;

use Klaviyo\Model\ListModel;

/**
 * The list manager class used to handle lists.
 */
class ListManager {

  use PagerTrait;

  /**
   * The Klaviyo API object to use for communicating with the Klaviyo API.
   *
   * @var Klaviyo\KlaviyoAPI
   */
  protected $api;
  protected $resourcePrefix = '/api/v1/';

  /**
   * The constructor for the list manager class.
   *
   * @param KlaviyoApi $api
   *   The Klaviyo API object to use for communicating with the Klaviyo API.
   */
  public function __construct(KlaviyoApi $api) {
    $this->api = $api;
  }

  /**
   * Retrieve the full resource path.
   *
   * @return string
   *   The full resource path incuding the resource prefix and resource path.
   *   Example: /api/v1/lists
   */
  public function getResourcePath($resource) {
    return $this->resourcePrefix . $resource;
  }

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

}
