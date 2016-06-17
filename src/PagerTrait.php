<?php

namespace Klaviyo;

use Klaviyo\Model\PageModel;

/**
 * Trait for adding a pager to a class.
 */
trait PagerTrait {

  /**
   * The Klavioyo api service.
   *
   * @var KlaviyoApi
   */
  protected $api;

  /**
   * Reteive all records for the specified paginated resource.
   *
   * @param string $resource
   *   The resource path to retrieve and paginate against.
   *
   * @return array
   *    An array of all records retrieved from the API.
   */
  public function getAllRecords($resource) {
    $page = $this->getPage($resource);

    $records = array_map(__NAMESPACE__ . '\ModelFactory::create', $page->getData());
    while (count($records) < $page->getTotal()) {
      $page = $this->getPage($resource, $page->getNextPage());
      $records = array_merge($records, array_map(__NAMESPACE__ . '\ModelFactory::create', $page->getData()));
    }

    return $records;
  }

  /**
   * Retrieve the records from a specific page.
   *
   * @param string $resource
   *   The resource path to retrieve and paginate against.
   *
   * @return array
   *    An array of all records retrieved from the API for the specified page.
   */
  public function getRecordsFromSpecificPage($resource, $page = 0, $count = 0) {
    $page = $this->getPage($resource, $page, $count);
    return array_map(__NAMESPACE__ . '\ModelFactory::create', $page->getData());
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
  public function getPage($resource, $page = 0, $count = 0) {
    $options = ['query' => ['page' => $page, 'count' => $count]];
    $response = $this->api->request('GET', $resource, $options);
    return new PageModel(json_decode($response->getBody(), TRUE));
  }

}
