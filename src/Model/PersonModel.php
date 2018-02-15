<?php

namespace Klaviyo\Model;

use Klaviyo\Exception\CannotDeleteRequiredSpecialAttributeKeyException;
use Klaviyo\Exception\InvalidSpecialAttributeKeyException;

/**
 * Simple model for a Klaviyo "Person".
 */
class PersonModel extends BaseModel
{
    protected $id;
    protected $objectType = 'person';
    protected $email;
    protected $firstName;
    protected $lastName;
    protected $organization;
    protected $title;
    protected $city;
    protected $region;
    protected $zip;
    protected $country;
    protected $timezone;
    protected $phoneNumber;
    protected $customAttributes;
    protected $unsetAttributes;
    protected static $optionalDefaults = [
        'id' => '',
        '$last_name' => '',
        '$organization' => '',
        '$title' => '',
        '$city' => '',
        '$region' => '',
        '$zip' => '',
        '$country' => '',
        '$timezone' => '',
        '$phone_number' => '',
    ];
    protected static $attributeKeys = [
        'object',
        'id',
        '$email',
        '$first_name',
        '$last_name',
        '$organization',
        '$title',
        '$city',
        '$region',
        '$zip',
        '$country',
        '$timezone',
        '$phone_number',
    ];

    /**
     * {@inheritdoc}
     */
    public function __construct($configuration)
    {
        parent::__construct($configuration);

        $this->setAttributes($configuration);
    }

    /**
     * {@inheritdoc}
     */
    public static function createFromJson($json = '')
    {
        $configuration = json_decode($json, true);

        $allowed_attributes = array_flip(array_filter(array_keys($configuration), function ($attribute_key) {
            // The API is returning these values as custom attributes when it really
            // probably should not.
            return !($attribute_key === 'email' || $attribute_key === 'first_name' || $attribute_key === 'last_name');
        }));
        $configuration = array_intersect_key($configuration, $allowed_attributes);

        return new static($configuration);
    }

    /**
     * Set the attributes for the person model.
     */
    protected function setAttributes($configuration)
    {
        $this->id = $configuration['id'];
        $this->email = $configuration['$email'];
        $this->firstName = $configuration['$first_name'];
        $this->lastName = $configuration['$last_name'];
        $this->organization = $configuration['$organization'];
        $this->title = $configuration['$title'];
        $this->city = $configuration['$city'];
        $this->region = $configuration['$region'];
        $this->zip = $configuration['$zip'];
        $this->country = $configuration['$country'];
        $this->timezone = $configuration['$timezone'];
        $this->phoneNumber = $configuration['$phone_number'];
        if (!empty($configuration['$unset'])) {
            $this->unsetAttributes = $configuration['$unset'];
        }

        $this->setCustomAttributes($configuration);
    }

    /**
     * Update the person model from an array.
     *
     * @return $this
     */
    public function updateFromArray($configuration)
    {
        $configuration += $this->toArray();
        $this->setAttributes($configuration);

        return $this;
    }

    /**
     * Retrieve an array of all attribute keys.
     */
    public static function getAttributeKeys()
    {
        return self::$attributeKeys;
    }

    /**
     * Set the custom attributes for the person.
     */
    private function setCustomAttributes($configuration)
    {
        $custom_attribute_keys = array_flip(array_filter(array_keys($configuration), [__CLASS__, 'isCustomAttributeKey']));
        $custom_attributes = array_intersect_key($configuration, $custom_attribute_keys);
        $this->customAttributes = $custom_attributes;
    }

    /**
     * Determine if the attribute is a custom attribute.
     *
     * @return bool
     *   Returns TRUE if the attribute is considered to be a custom attribute.
     */
    public static function isCustomAttributeKey($attribute_key)
    {
        return !self::isSpecialAttributeKey($attribute_key);
    }

    /**
     * Determine if the attribute is a special attribute.
     *
     * @return bool
     *   Returns TRUE if the attribute is considered to be a "special" Klaviyo
     *   attribute.
     */
    public static function isSpecialAttributeKey($attribute_key)
    {
        return in_array($attribute_key, self::$attributeKeys);
    }

    /**
     * Retrieve a custom attribute by its attribute key.
     */
    public function getCustomAttribute($attribute_key)
    {
        return !empty($this->customAttributes[$attribute_key]) ? $this->customAttributes[$attribute_key] : '';
    }

    /**
     * Retrieve all custom attributes for the person.
     */
    public function getAllCustomAttributes()
    {
        return $this->customAttributes;
    }

    /**
     * Delete an attribute from the person model.
     *
     * @param string $attribute_key
     *   The attribute key of the attribute to delete.
     *
     * @return $this
     */
    public function deleteAttribute($attribute_key)
    {
        if (self::isSpecialAttributeKey($attribute_key) && isset(self::$optionalDefaults[$attribute_key])) {
            $property = self::getModelPropertyFromSpecialAttributeKey($attribute_key);
            $this->{$property} = self::$optionalDefaults[$attribute_key];
        } elseif ($this->getCustomAttribute($attribute_key)) {
            unset($this->customAttributes[$attribute_key]);
        } elseif (isset(self::$attributeKeys)) {
            throw new CannotDeleteRequiredSpecialAttributeKeyException(sprintf('%s is a required special attribute and cannot be deleted.', $attribute_key));
        }

        $this->unsetAttributes[] = $attribute_key;
        return $this;
    }

    /**
     * Retrieve the model property from the special attribute key.
     *
     * @param string $attribute_key
     *   The special attribute key for which to retrieve the model property.
     *
     * @return string
     *   The string representing the model property.
     */
    public static function getModelPropertyFromSpecialAttributeKey($attribute_key)
    {
        if (!self::isSpecialAttributeKey($attribute_key)) {
            throw new InvalidSpecialAttributeKeyException(sprintf('%s is not a valid special Klaivyo attribute.', $attribute_key));
        }

        if (strpos($attribute_key, '$') !== false) {
            $attribute_key_segements = explode('_', substr($attribute_key, 1));
            $attribute_key = $attribute_key_segements[0] . implode('', array_map('ucfirst', array_slice($attribute_key_segements, 1)));
        } elseif ($attribute_key === 'object') {
            $attribute_key = 'objectType';
        }

        return $attribute_key;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $serializable_options = [
            // Object type intentionally left out because the Klaviyo API treats it as
            // a custom field.
            'id' => $this->id,
            '$email' => $this->email,
            '$first_name' => $this->firstName,
            '$last_name' => $this->lastName,
            '$organization' => $this->organization,
            '$title' => $this->title,
            '$city' => $this->city,
            '$region' => $this->region,
            '$zip' => $this->zip,
            '$country' => $this->country,
            '$timezone' => $this->timezone,
            '$phone_number' => $this->phoneNumber,
        ] + $this->getAllCustomAttributes();

        if (!empty($this->unsetAttributes)) {
            $serializable_options['$unset'] = $this->unsetAttributes;
        }

        return $serializable_options;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        // Add object type back when converting to an array since we removed it due
        // to an oddity in the Klaviyo API.
        return ['object' => $this->objectType] + json_decode(json_encode($this), true);
    }
}
