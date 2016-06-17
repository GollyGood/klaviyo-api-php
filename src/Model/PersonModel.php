<?php

namespace Klaviyo\Model;

/**
 * Simple model for a Klaviyo "Person".
 */
class PersonModel extends BaseModel {

  protected $id;
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

  /**
   * {@inheritdoc}
   */
  public function __construct($configuration) {
    $configuration = $this->cleanKeys($configuration);
    parent::__construct($configuration);

    $this->id = $configuration['id'];
    $this->email = $configuration['email'];
    $this->firstName = $configuration['first_name'];
    $this->lastName = $configuration['last_name'];
    $this->organization = $configuration['organization'];
    $this->title = $configuration['title'];
    $this->city = $configuration['city'];
    $this->region = $configuration['region'];
    $this->zip = $configuration['zip'];
    $this->country = $configuration['country'];
    $this->timezone = $configuration['timezone'];
    $this->phoneNumber = $configuration['phone_number'];
  }

  public function getObjectType() {
    return $this->objectType;
  }

  /**
   * Retrieve the id of the person.
   */
  public function getId() {
    return $this->id;
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
   * {@inheritdoc}
   */
  public function jsonSerialize() {
    return parent::jsonSerialize() + [
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
    ];
  }

}
