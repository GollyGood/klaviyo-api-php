<?php

namespace Klaviyo;

use Klaviyo\Model\KlaviyoModel;
use Klaviyo\Model\ListModel;

/**
 * Model creation factory.
 */
class ModelFactory {

  /**
   * Create a new model.
   *
   * @param array $configuration
   *   The key, value pair array to use for populating the data model.
   * @param string $type
   *   The type of the data model to create.
   *
   * @return KlavioModel
   *   A data model representing the specified data type.
   */
  public static function create($configuration, $type = '') {
    $type = self::getModelType($type, $configuration);

    switch ($type) {
      case 'list':
        $model = ListModel::Create($configuration);
        break;

      default:
        $model = new KlaviyoModel();
    }

    return $model;
  }

  /**
   * Get the model type.
   *
   * @param string $type
   *   If set then we will check out data map and retrieve the model type.
   * @param array $configuration
   *   The key, value pair array to use for populating the data model.
   *
   * @return string
   *   The model data type.
   */
  public static function getModelType($type = '', $configuration = array()) {
    if (empty($type) && !empty($configuration)) {
      $type = $configuration['object'];
    }
    if (strpos($type, '$') === 0) {
      $type = KlaviyoApi::$dataMap[$type];
    }

    return $type;
  }

}
