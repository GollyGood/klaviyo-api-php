<?php

namespace Klaviyo\Model;

use Klaviyo\KlaviyoApi;

/**
 * Model creation factory.
 */
class ModelFactory {

  protected static $modelMap = [
    'list' => ListModel::class,
    'membership' => MembershipModel::class,
    'page' => PageModel::class,
    'person' => PersonModel::class,
    'person_list' => PersonListModel::class,
    'empty' => EmptyModel::class,
  ];

  /**
   * Create a new model.
   *
   * @param array $configuration
   *   The key, value pair array to use for populating the data model.
   * @param string $type
   *   The type of the data model to create.
   *
   * @return ModelInterface
   *   A data model representing the specified data type.
   */
  public static function create($configuration, $type = '') {
    return self::callModelCreationMethod('create', $configuration, $type);
  }

  /**
   * Create a new model from JSON.
   *
   * @param array $configuration
   *   The key, value pair array to use for populating the data model.
   * @param string $type
   *   The type of the data model to create.
   *
   * @return ModelInterface
   *   A data model representing the specified data type.
   */
  public static function createFromJson($configuration, $type = '') {
    return self::callModelCreationMethod('createFromJson', $configuration, $type);
  }

  /**
   * Create a new model from using the specified method.
   *
   * @param string $method
   *   The method to execute on the model for creation.
   * @param array $configuration
   *   The key, value pair array to use for populating the data model.
   * @param string $type
   *   The type of the data model to create.
   *
   * @return ModelInterface
   *   A data model representing the specified data type.
   */
  public static function callModelCreationMethod($method, $configuration, $type = '') {
    $type = self::getModelType($type, $configuration);

    $model = NULL;
    if (isset(self::$modelMap[$type])) {
      $model = call_user_func(self::$modelMap[$type] . "::$method", $configuration);
    }
    else {
      $model = call_user_func(self::$modelMap['empty'] . "::$method", $configuration);
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
  public static function getModelType($type = '', $configuration = []) {
    if (empty($type) && !empty($configuration)) {
      $type = $configuration['object'];
    }
    if (!empty(KlaviyoApi::$dataMap[$type])) {
      $type = KlaviyoApi::$dataMap[$type];
    }

    return $type;
  }

}
