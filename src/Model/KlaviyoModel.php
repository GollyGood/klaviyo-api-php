<?php

namespace Klaviyo\Model;

class KlaviyoModel implements \JsonSerializable {

  public function __construct($configuration) {
    foreach ($configuration as $key => $value) {
      $this->$key = $value;
    }
  }

  public static function create($configuration) {
    return new static($configuration);
  }

  public static function createFromJson($json) {
    $configuration = json_decode($json, TRUE);
    return new static($configuration);
  }

  /**
   * {@inheritdoc}
   */
  public function jsonSerialize() {
    return get_object_vars($this);
  }

}
