<?php

namespace Klaviyo;

use Klaviyo\Model\KlaviyoModel;
use Klaviyo\Model\ListModel;
use Klaviyo\Model\PageModel;

/**
 * Trait for adding a pager to a class.
 */
trait PagerTrait {

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

    $records = array_map(array($this, 'createModel'), $page->getData());
    while (count($records) < $page->getTotal()) {
      $page = $this->getPage($resource, $page->getNextPage());
      $records = array_merge($records, array_map(array($this, 'createModel'), $page->getData()));
    }

    return $records;
  }

  /**
   * Retrieve the model for the specified record.
   *
   * @param array $configuration
   *   The configuration to use to populate the model.
   *
   * @return KlaviyoModel
   *   The instance of a model to represent the record.
   */
  public function createModel($configuration) {
    $model = new KlaviyoModel();

    switch (KlaviyoApi::$dataMap[$configuration['object']]) {
      case 'list':
        $model = ListModel::Create($configuration);
        break;
    }

    return $model;
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
    return array_map(array($this, 'createModel'), $page->getData());
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
