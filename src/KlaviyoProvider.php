<?php

namespace Klaviyo;

use Klaviyo\Model\ModelFactory;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * The Klaviyo api service container.
 */
class KlaviyoProvider implements ServiceProviderInterface
{

    protected $apiKey;

    /**
     * Provider constructor.
     *
     * @param string $api_key
     *   The API key to create the api service with.
     */
    public function __construct($api_key)
    {
        $this->apiKey = $api_key;
    }

    /**
     * {@inheritdoc}
     */
    public function register(Container $container)
    {
        $container['api_key'] = $this->apiKey;

        $container = $this->registerServices($container);
        $container = $this->registerModelFactory($container);
    }

    /**
     * Register all services with the continer.
     */
    protected function registerServices(Container $container)
    {
        $container['api'] = function ($c) {
            return KlaviyoApi::create($c['api_key']);
        };
        $container['campaign'] = function ($c) {
            return CampaignService::create($c['api']);
        };
        $container['lists'] = function ($c) {
            return ListService::create($c['api']);
        };
        $container['person'] = function ($c) {
            return PersonService::create($c['api']);
        };
        $container['template'] = function ($c) {
            return TemplateService::create($c['api']);
        };
        $container['track'] = function ($c) {
            return TrackService::create($c['api']);
        };

        return $container;
    }

    /**
     * Register our model factory with the container.
     */
    protected function registerModelFactory(Container $container)
    {
        $container['model.factory.modelMap'] = ModelFactory::getModelMap();
        $this->registerModelFactoryDefaultParams($container);
        $this->registerModelFactoryCreate($container);
        $this->registerModelFactoryCreateFromJson($container);

        return $container;
    }

    /**
     * Register our model factory creation with the container.
     */
    protected function registerModelFactoryCreate(Container $container)
    {
        $self = $this;
        $container['model.factory'] = $container->factory(function ($c) use ($self) {
            $configuration = $c['model.factory.params']['configuration'];
            $type = $c['model.factory.params']['type'];

            $model = ModelFactory::create($configuration, $type);
            $self->registerModelFactoryDefaultParams($c);
            return $model;
        });
    }

    /**
     * Register our model factory creation from JSON with the container.
     */
    protected function registerModelFactoryCreateFromJson(Container $container)
    {
        $self = $this;
        $container['model.factory.json'] = $container->factory(function ($c) use ($self) {
            $json = $c['model.factory.json.params']['json'];
            $type = $c['model.factory.json.params']['type'];

            $model = ModelFactory::createFromJson($json, $type);
            $self->registerModelFactoryDefaultParams($c);
            return $model;
        });
    }

    /**
     * Register our default parameters for our model creation factories.
     */
    protected function registerModelFactoryDefaultParams(Container $container)
    {
        $container['model.factory.params'] = [
            'configuration' => [],
            'type' => '',
        ];
        $container['model.factory.json.params'] = [
            'json' => '',
            'type' => '',
        ];

        return $container;
    }
}
