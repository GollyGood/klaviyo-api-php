<?php

namespace Klaviyo\Model;

use Klaviyo\KlaviyoApi;

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
        $model = ListModel::create($configuration);
        break;

      case 'membership':
        $model = MembershipModel::create($configuration);
        break;

      case 'page':
        $model = PageModel::create($configuration);
        break;

      case 'person':
        $model = PersonModel::create($configuration);
        break;

      default:
        $model = EmptyModel::create();
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
    if (!empty(KlaviyoApi::$dataMap[$type])) {
      $type = KlaviyoApi::$dataMap[$type];
    }

    return $type;
  }

}
