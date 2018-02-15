<?php

namespace Klaviyo;

use Klaviyo\Exception\IsNotAServiceException;
use Klaviyo\Exception\ServiceNotFoundException;
use Pimple\Container;

/**
 * The Klaviyo API service container, model, and api wrapper.
 */
class KlaviyoFacade
{
    protected $container;

    /**
     * The service container constructor.
     *
     * @param Container $container
     *   A the service continer to attach the Klaviyo service provider.
     * @param string $api_key
     *   The Klaviyo API key to use when creating the Klaviyo api service.
     */
    public function __construct(Container $container, $api_key)
    {
        $this->container = $container;
        $this->container->register(new KlaviyoProvider($api_key));
    }

    /**
     * Factory method to create a new service continer.
     *
     * @param string $api_key
     *   The Klaviyo API key to use when creating the Klaviyo api service.
     *
     * @return KlaviyoServiceContainer
     *   An instance of the a new service container.
     */
    public static function create($api_key)
    {
        return new static(
            new Container(),
            $api_key
        );
    }

    /**
     * Retrieve the container.
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Retrieve a service from the service container.
     *
     * @param string $service_name
     *   The name of the service to retrieve.
     *
     * @return ServiceInterface
     *   The service.
     */
    public function service($service_name)
    {
        if (!isset($this->container[$service_name])) {
            throw new ServiceNotFoundException(sprintf('The service %s could not be found.', $service_name));
        }
        if (!($this->container[$service_name] instanceof ServiceInterface)) {
            throw new IsNotAServiceException(sprintf('%s is not a service, please use the correct wrapper method.', $service_name));
        }

        return $this->container[$service_name];
    }

    /**
     * The model factory wrapper method.
     *
     * @param array $configuration
     *   The key, value pair array to use for populating the data model.
     * @param string $type
     *   The type of the data model to create.
     *
     * @return Klaviyo\Model\ModelInterface
     *   A data model representing the specified data type.
     */
    public function model($configuration = [], $type = '')
    {
        $this->container['model.factory.params'] = [
            'type' => $type,
            'configuration' => $configuration,
        ];
        return $this->container['model.factory'];
    }

    /**
     * The create from json model factory wrapper method.
     *
     * @param string $json
     *   The JSON encoded key, value pair array to use for populating the data
     *   model.
     * @param string $type
     *   The type of the data model to create.
     *
     * @return Klaviyo\Model\ModelInterface
     *   A data model representing the specified data type.
     */
    public function modelFromJson($json = '', $type = '')
    {
        $this->container['model.factory.json.params'] = [
            'type' => $type,
            'json' => $json,
        ];
        return $this->container['model.factory.json'];
    }

    /**
     * Retrieve the model class of the specified model.
     */
    public function getModelClass($type)
    {
        $mapper = $this->container['model.factory.modelMap'];
        return !empty($mapper[$type]) ? $mapper[$type] : $mapper['empty'];
    }
}
