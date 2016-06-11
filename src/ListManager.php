<?php

namespace Klaviyo;

use Klaviyo\Model\ListModel;

/**
 * The list manager class used to handle lists.
 */
class ListManager {

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
    $list_page = $this->getListPage();

    $lists = $list_page['data'];
    while (count($lists) < $list_page['total']) {
      $list_page = $this->getListPage($list_page['page'] + 1);
      $lists = array_merge($lists, $list_page['data']);
    }

    return $lists;
  }

  /**
   * Retrieve a specific page from Klaviyo.
   *
   * @param int $page
   *   The page number to retrieve.
   * @param int $count
   *   The number of items per page.
   *
   * @return array
   *   An array of information that represents a page.
   */
  public function getListPage($page = 0, $count = 0) {
    $options = ['query' => ['page' => $page, 'count' => $count]];
    $response = $this->api->request('GET', $this->getResourcePath('lists'), $options);
    $body = json_decode($response->getBody(), TRUE);

    foreach ($body['data'] as $data) {
      $lists[] = new ListModel($data);
    }
    $body['data'] = $lists;

    return $body;
  }

}
