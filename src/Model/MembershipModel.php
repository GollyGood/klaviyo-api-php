<?php

namespace Klaviyo\Model;

/**
 * Simple model for a Klaviyo "Membership".
 */
class MembershipModel extends BaseModel {

  protected $email;
  protected $dateAdded;
  protected $dateFormat = 'Y-m-d H:i:s';
  protected $person;

  /**
   * {@inheritdoc}
   */
  public function __construct($configuration) {
    parent::__construct($configuration);

    $this->email = $configuration['email'];
    $this->dateAdded = new \DateTime($configuration['date_added']);
    $this->person = PersonModel::create($configuration['person']);
  }

  /**
   * Retrieves the added date of the membership.
   *
   * @return \DateTime
   *   Returns a DateTime object of the created date of the list.
   */
  public function getDateAdded() {
    return $this->dateAdded;
  }

  /**
   * Retrieves the membership email.
   */
  public function getEmail() {
    return $this->email;
  }

  /**
   * Retrieves the person model associated with the membership.
   *
   * @return PersonModel
   *   The person model object assocated with the membership.
   */
  public function getPerson() {
    return $this->person;
  }

  /**
   * {@inheritdoc}
   */
  public function jsonSerialize() {
    return [
      'email' => $this->getEmail(),
      'date_added' => $this->getDateAdded()->format($this->dateFormat),
      'person' => $this->getPerson(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function toArray() {
    return [
      'object' => $this->getObjectType(),
      'email' => $this->getEmail(),
      'date_added' => $this->getDateAdded()->format($this->dateFormat),
      'person' => $this->getPerson()->toArray(),
    ];
  }

}
