<?php

namespace Klaviyo\Model;

/**
 * Simple model for a Klaviyo "Person" reference.
 */
class PersonReferenceModel extends BaseModel {

  protected $id;
  protected $email;

  /**
   * {@inheritdoc}
   */
  public function __construct($configuration) {
    parent::__construct($configuration);

    $this->id = $configuration['id'];
    $this->email = $configuration['email'];
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
   * {@inheritdoc}
   */
  public function jsonSerialize() {
    return parent::jsonSerialize() + [
      'id' => $this->getId(),
      'email' => $this->getEmail(),
    ];
  }

}
