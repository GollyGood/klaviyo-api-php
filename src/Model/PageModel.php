<?php

namespace Klaviyo\Model;

use Klaviyo\KlaviyoApi;

/**
 * Simple model that represents a page.
 */
class PageModel {

  protected $objectType;
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
   * Retrieve the model object type of the items we are paginating.
   */
  public function getObjectType() {
    return $this->objectType;
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

}
