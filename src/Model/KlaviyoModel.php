<?php

namespace Klaviyo\Model;

class KlaviyoModel implements \JsonSerializable {

  public function __construct($configuration) {
    foreach ($configuration as $key => $value) {
      $this->$key = $value;
    }
  }

  /**
   * @todo: Document.
   */
  public function cleanKeys($configuration) {
    $new_configuration = [];

    foreach ($configuration as $key => $value) {
      if (strpos($key, '$') === 0) {
        $key = substr($key, 1);
      }

      $new_configuration[$key] = $value;
    }

    return $new_configuration;
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
