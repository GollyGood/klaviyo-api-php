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
   * {@inheritdoc}
   */
  public function jsonSerialize() {
    $data_map = array_flip(KlaviyoApi::$dataMap);
    $object_type = $this->objectType;

    return [
      'object' => !empty($data_map[$object_type]) ? $data_map[$object_type] : $object_type,
      'start' => $this->start,
      'end' => $this->end,
      'page_size' => $this->pageSize,
      'total' => $this->total,
      'page' => $this->page,
      'data' => $this->data,
    ];
  }

}
