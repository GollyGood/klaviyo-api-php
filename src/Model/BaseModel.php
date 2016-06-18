<?php

namespace Klaviyo\Model;

/**
 * The base Klaviyo data model.
 */
abstract class BaseModel implements ModelInterface {

  protected $objectType = '';

  /**
   * The constructor of a Klaviyo data model.
   *
   * @param array $configuration
   *   The key, value pair array to use for populating the data model.
   */
  public function __construct($configuration = []) {
    if (!empty($configuration['object'])) {
      $this->objectType = $configuration['object'];
    }
  }

  /**
   * Retrieve the Klaviyo object type for a model.
   */
  public function getObjectType() {
    return $this->objectType;
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
  public static function create($configuration = []) {
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
   * {@inheritdoc}
   */
  public function jsonSerialize() {
    return [
      'object' => $this->getObjectType(),
    ];
  }

  /**
   * Convert the model to an array.
   */
  public function toArray() {
    return json_decode(json_encode($this), TRUE);
  }

}
