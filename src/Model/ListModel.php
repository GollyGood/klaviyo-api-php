<?php

namespace Klaviyo\Model;

/**
 * Simple model for a Klaviyo "List".
 */
class ListModel extends KlaviyoModel {

  protected $id;
  protected $name;
  protected $listType;
  protected $created;
  protected $updated;
  protected $personCount;
  protected $dateFormat = 'Y-m-d H:i:s';

  /**
   * {@inheritdoc}
   */
  public function __construct($configuration) {
    $this->id = $configuration['id'];
    $this->setName($configuration['name']);
    $this->listType = $configuration['list_type'];
    $this->created = new \DateTime($configuration['created']);
    $this->updated = new \DateTime($configuration['updated']);
    $this->personCount = $configuration['person_count'];
  }

  /**
   * Retrieves the created date of the list.
   *
   * @return \DateTime
   *   Returns a DateTime object of the created date of the list.
   */
  public function getCreated() {
    return $this->created;
  }

  /**
   * Retrieves the id of the list.
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Retrieves the name of the list.
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Set the name property.
   *
   * @return $this
   */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  /**
   * Retrieves the list type of the list.
   */
  public function getListType() {
    return $this->listType;
  }

  /**
   * Retrieves the updated date of the list.
   *
   * @return \DateTime
   *   Returns a DateTime object of the updated date of the list.
   */
  public function getUpdated() {
    return $this->updated;
  }

  /**
   * Retrieves the number of persons subscribed to the list.
   */
  public function getPersonCount() {
    return $this->personCount;
  }

  /**
   * {@inheritdoc}
   */
  public function jsonSerialize() {
    return [
      'id' => $this->getId(),
      'name' => $this->getName(),
      'list_type' => $this->getListType(),
      'created' => $this->getCreated()->format($this->dateFormat),
      'updated' => $this->getUpdated()->format($this->dateFormat),
      'person_count' => $this->getPersonCount(),
    ];
  }

}
