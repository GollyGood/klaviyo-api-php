<?php

namespace Klaviyo\Model;

/**
 * Simple model for a Klaviyo "Person".
 */
class PersonModel extends BaseModel {

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
  protected $optionalDefaults = [
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
  public function __construct($configuration) {
    parent::__construct($configuration);
    $this->setAttributes($configuration);
  }

  /**
   * {@inheritdoc}
   */
  public static function createFromJson($json) {
    $configuration = json_decode($json, TRUE);

    $allowed_attributes = array_flip(array_filter(array_keys($configuration), function($attribute_key) {
      // The API is returning these values as custom attributes when it really
      // probably should not.
      // @todo: Test!
      return !($attribute_key === 'email' || $attribute_key === 'first_name' || $attribute_key === 'last_name');
    }));
    $configuration = array_intersect_key($configuration, $allowed_attributes);

    return new static($configuration);
  }

  /**
   * Set the attributes for the person model.
   *
   * @todo: Test!
   */
  public function setAttributes($configuration) {
    $configuration += $this->optionalDefaults;

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

    $this->setCustomAttributes($configuration);
  }

  /**
   * Update the person model from an array.
   *
   * @todo: Test.
   *
   * @return $this
   */
  public function updateFromArray($configuration) {
    $configuration += $this->toArray();
    $this->setAttributes($configuration);

    return $this;
  }

  /**
   * Retrieve an array of all attribute keys.
   */
  public static function getAttributeKeys() {
    return self::$attributeKeys;
  }

  /**
   * Retrieve the id of the person.
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Set the id of the person.
   */
  public function setId($id) {
    $this->id = $id;

    return $this;
  }

  /**
   * Retrieve the email of the person.
   */
  public function getEmail() {
    return $this->email;
  }

  /**
   * Retrieve the first name of the person.
   */
  public function getFirstName() {
    return $this->firstName;
  }

  /**
   * Retrieve the last name of the person.
   */
  public function getLastName() {
    return $this->lastName;
  }

  /**
   * Retrieve the organization of the person.
   */
  public function getOrganization() {
    return $this->organization;
  }

  /**
   * Retrieve the title of the person.
   */
  public function getTitle() {
    return $this->title;
  }

  /**
   * Retrieve the city of the person.
   */
  public function getCity() {
    return $this->city;
  }

  /**
   * Retrieve the region of the person.
   */
  public function getRegion() {
    return $this->region;
  }

  /**
   * Retrieve the zip code of the person.
   */
  public function getZip() {
    return $this->zip;
  }

  /**
   * Retrieve the country of the person.
   */
  public function getCountry() {
    return $this->country;
  }

  /**
   * Retrieve the time zone of the person.
   */
  public function getTimeZone() {
    return $this->timezone;
  }

  /**
   * Retrieve the phone number of the person.
   */
  public function getPhoneNumber() {
    return $this->phoneNumber;
  }

  /**
   * Set the custom attributes for the person.
   */
  private function setCustomAttributes($configuration) {
    $custom_attribute_keys = array_flip(array_filter(array_keys($configuration), [__CLASS__, 'isCustomAttributeKey']));
    $this->customAttributes = array_intersect_key($configuration, $custom_attribute_keys);
  }

  /**
   * Determine if the attribute is a custom attribute.
   *
   * @return bool
   *   Returns TRUE if the attribute is considered to be a custom attribute.
   */
  public static function isCustomAttributeKey($attribute_key) {
    return !self::isSpecialAttributeKey($attribute_key);
  }

  /**
   * Determine if the attribute is a special attribute.
   *
   * @return bool
   *   Returns TRUE if the attribute is considered to be a "special" Klaviyo
   *   attribute.
   */
  public static function isSpecialAttributeKey($attribute_key) {
    return ((strpos($attribute_key, '$') === 0) || $attribute_key == 'id' || $attribute_key == 'object');
  }

  /**
   * Retrieve a custom attribute by its attribute key.
   */
  public function getCustomAttribute($attribute_key) {
    return !empty($this->customAttributes[$attribute_key]) ? $this->customAttributes[$attribute_key] : '';
  }

  /**
   * Retrieve all custom attributes for the person.
   */
  public function getAllCustomAttributes() {
    return $this->customAttributes;
  }

  /**
   * {@inheritdoc}
   */
  public function jsonSerialize() {
    return [
      // Object type intentionally left out because the Klaviyo API treats it as
      // a custom field.
      'id' => $this->getId(),
      '$email' => $this->getEmail(),
      '$first_name' => $this->getFirstName(),
      '$last_name' => $this->getLastName(),
      '$organization' => $this->getOrganization(),
      '$title' => $this->getTitle(),
      '$city' => $this->getCity(),
      '$region' => $this->getRegion(),
      '$zip' => $this->getZip(),
      '$country' => $this->getCountry(),
      '$timezone' => $this->getTimeZone(),
      '$phone_number' => $this->getPhoneNumber(),
    ] + $this->getAllCustomAttributes();
  }

  /**
   * {@inheritdoc}
   */
  public function toArray() {
    // Add object type back when converting to an array since we removed it due
    // to an oddity in the Klaviyo API.
    return ['object' => $this->getObjectType()] + json_decode(json_encode($this), TRUE);
  }

}
