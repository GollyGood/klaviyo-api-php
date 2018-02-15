<?php

namespace Klaviyo\Model;

/**
 * The base Klaviyo data model.
 */
abstract class BaseModel implements ModelInterface
{
    protected $objectType = '';
    protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * An array of attributes/properties that may be altered.
     */
    protected static $mutableAttributes = [];

    protected static $optionalDefaults = [];

    /**
     * The constructor of a Klaviyo data model.
     *
     * @param array $configuration
     *   The key, value pair array to use for populating the data model.
     */
    public function __construct(&$configuration = [])
    {
        $configuration += static::$optionalDefaults;

        if (!empty($configuration['object'])) {
            $this->objectType = $configuration['object'];
        }
    }

    /**
     * PHPs magic get method to provide access to our protected attributes.
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->{$property};
        }
    }

    /**
     * PHPs magic set method to provide access to our mutable attributes.
     *
     * @return $this
     */
    public function __set($property, $value)
    {
        if (in_array($property, static::$mutableAttributes)) {
            $this->{$property} = $value;
        }

        return $this;
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
    public static function create($configuration = [])
    {
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
    public static function createFromJson($json = '')
    {
        $configuration = json_decode($json, true);
        if (is_null($configuration)) {
            $configuration = [];
        }
        return new static($configuration);
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'object' => $this->objectType,
        ];
    }

    /**
     * Convert the model to an array.
     */
    public function toArray()
    {
        return json_decode(json_encode($this), true);
    }
}
