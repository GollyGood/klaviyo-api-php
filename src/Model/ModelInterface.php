<?php

namespace Klaviyo\Model;

/**
 * The base Klaviyo data model.
 */
interface ModelInterface extends \JsonSerializable
{
    /**
     * Helper method to create the data model.
     *
     * @param array $configuration
     *   The key, value pair array to use for populating the data model.
     *
     * @return KlaviyoModel
     *   An instance of the Klaviyo data model.
     */
    public static function create($configuration);

    /**
     * Helper method to create the data model from a JSON array.
     *
     * @param array $json
     *   The configuration json to use for populating the data model.
     *
     * @return KlaviyoModel
     *   An instance of the Klaviyo data model.
     */
    public static function createFromJson($json);

    /**
     * Convert the model to an array.
     */
    public function toArray();
}
