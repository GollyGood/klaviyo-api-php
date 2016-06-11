<?php

namespace Klaviyo\Model;

class PersonModel extends KlaviyoModel {

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

  public function __construct($configuration) {
    $configuration = $this->cleanKeys($configuration);

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

  public function getId() {
    return $this->id;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getFirstName() {
    return $this->firstName;
  }

  public function getLastName() {
    return $this->lastName;
  }

  public function getOrganization() {
    return $this->organization;
  }

  public function getTitle() {
    return $this->title;
  }

  public function getCity() {
    return $this->city;
  }

  public function getRegion() {
    return $this->region;
  }

  public function getZip() {
    return $this->zip;
  }

  public function getCountry() {
    return $this->country;
  }

  public function getTimeZone() {
    return $this->timezone;
  }

  public function getPhoneNumber() {
    return $this->phoneNumber;
  }

  public function jsonSerialize() {
    return [
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
