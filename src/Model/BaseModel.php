<?php

namespace Klaviyo\Model;

use Klaviyo\Exception\CannotModifyImmutablePropertyException;

/**
 * The base Klaviyo data model.
 *
 * @property string $objectType
 */
abstract class BaseModel implements ModelInterface
{
    protected $objectType = '';
    protected $dateFormat = 'Y-m-d H:i:s';

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
     *
     * @param string $property
     * @return mixed;
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->{$property};
        }
    }

    /**
     * Helper method to create the data model.
     *
     * @param array $configuration
     *   The key, value pair array to use for populating the data model.
     *
     * @return mixed
     *   An instance of the Klaviyo data model.
     */
    public static function create($configuration = [])
    {
        return new static($configuration);
    }

    /**
     * Helper method to create the data model from a JSON array.
     *
     * @param array|string $json
     *   The configuration json to use for populating the data model.
     *
     * @return mixed
     *   An instance of the Klaviyo data model.
     */
    public static function createFromJson($json)
    {
        if (is_string($json)) {
            $configuration = json_decode($json, true);
        } else {
            $configuration = $json;
        }
        if (is_null($configuration)) {
            $configuration = [];
        }
        return new static($configuration);
    }

    /**
     * Retrieve an HTML object from the specified string.
     *
     * @param string $content
     *   The valid HTML to transform into an HTML object.
     *
     * @return \DOMDocument
     *   The HTML object that may used to manipulate the DOM.
     */
    public function getHtmlObjectFromString($content)
    {
        $dom = new \DOMDocument();
        $dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        return $dom;
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
