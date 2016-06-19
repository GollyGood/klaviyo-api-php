<?php

namespace Klaviyo;

use Klaviyo\Model\ModelFactory;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * The Klaviyo api service container.
 */
class KlaviyoProvider implements ServiceProviderInterface {

  protected $apiKey;

  /**
   * Provider constructor.
   *
   * @param string $api_key
   *   The API key to create the api service with.
   */
  public function __construct($api_key) {
    $this->apiKey = $api_key;
  }

  /**
   * {@inheritdoc}
   */
  public function register(Container $container) {
    $container['api_key'] = $this->apiKey;

    $container['api'] = function ($c) {
      return KlaviyoApi::create($c['api_key']);
    };
    $container['lists'] = function ($c) {
      return ListService::create($c['api']);
    };
    $container['person'] = function ($c) {
      return PersonService::create($c['api']);
    };
    $container['track'] = function ($c) {
      return TrackService::create($c['api']);
    };

    $container['modelFactoryParams'] = [
      'type' => 'empty',
      'configuration' => [],
    ];
    $container['model_factory'] = $container->factory(function($c) {
      $model = ModelFactory::create($c['modelFactoryParams']['configuration'], $c['modelFactoryParams']['type']);
      $container['modelFactoryParams'] = [
        'type' => '',
        'configuration' => [],
      ];
      return $model;
    });
  }

}
