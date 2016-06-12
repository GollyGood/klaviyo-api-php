<?php

namespace Klaviyo\Model;

/**
 * The base Klaviyo data model.
 */
class KlaviyoModel implements \JsonSerializable {

  /**
   * The constructor of a Klaviyo data model.
   *
   * @param array $configuration
   *   The key, value pair array to use for populating the data model.
   */
  public function __construct($configuration = array()) {
    foreach ($configuration as $key => $value) {
      $this->$key = $value;
    }
  }

  /**
   * Helper method to create the data model.
   *
   * @param array $configuration
   *   The key, value pair array to use for populating the data model.
   *
   * @return KlaviyoModel
   *   An instance of the Klaviyo data model.
   */
  public static function create($configuration) {
    return new static($configuration);
  }

  /**
   * Helper method to create the data model from a JSON array.
   *
   * @param array $json
   *   The configuration json to use for populating the data model.
   *
   * @return KlaviyoModel
   *   An instance of the Klaviyo data model.
   */
  public static function createFromJson($json) {
    $configuration = json_decode($json, TRUE);
    return new static($configuration);
  }

  /**
   * Remove strange $ from the keys if it exists.
   *
   * @param array $configuration
   *   The key, value pair array to for cleaning.
   *
   * @return array
   *   The key, value pair array "cleaned".
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

  /**
   * {@inheritdoc}
   */
  public function jsonSerialize() {
    return get_object_vars($this);
  }

}
