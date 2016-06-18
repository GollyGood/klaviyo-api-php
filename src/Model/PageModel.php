<?php

namespace Klaviyo\Model;

use Klaviyo\KlaviyoApi;

/**
 * Simple model that represents a page.
 */
class PageModel extends BaseModel {

  protected $start;
  protected $end;
  protected $page;
  protected $pageSize;
  protected $total;
  protected $data;

  /**
   * The configuration to use to populate the Page model.
   */
  public function __construct($configuration) {
    $this->objectType = KlaviyoApi::$dataMap[$configuration['object']];
    $this->start = $configuration['start'];
    $this->end = $configuration['end'];
    $this->page = $configuration['page'];
    $this->pageSize = $configuration['page_size'];
    $this->total = $configuration['total'];
    $this->data = $configuration['data'];
  }

  /**
   * Retrieve the first record position within all the results.
   */
  public function getStart() {
    return $this->start;
  }

  /**
   * Retrieve the last record position within all the results.
   */
  public function getEnd() {
    return $this->end;
  }

  /**
   * Retrieve the current page number.
   */
  public function getPage() {
    return $this->page;
  }

  /**
   * Retrieve the number of records in the pge.
   */
  public function getPageSize() {
    return $this->pageSize;
  }

  /**
   * Retrieve the total number of all records.
   */
  public function getTotal() {
    return $this->total;
  }

  /**
   * Retrieve the contents of the page.
   */
  public function getData() {
    return $this->data;
  }

  /**
   * Retrieve the next page number.
   */
  public function getNextPage() {
    return $this->page + 1;
  }

  /**
   * {@inheritdoc}
   */
  public function jsonSerialize() {
    $data_map = array_flip(KlaviyoApi::$dataMap);
    $object_type = $this->objectType;

    return [
      'object' => !empty($data_map[$object_type]) ? $data_map[$object_type] : $object_type,
      'start' => $this->getStart(),
      'end' => $this->getEnd(),
      'page_size' => $this->getPageSize(),
      'total' => $this->getTotal(),
      'page' => $this->getPage(),
      'data' => $this->getData(),
    ];
  }

}
