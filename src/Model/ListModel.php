<?php

namespace Klaviyo\Model;

class ListModel extends KlaviyoModel {

  protected $id;
  protected $name;
  protected $listType;
  protected $created;
  protected $updated;
  protected $personCount;
  protected $dateFormat = 'Y-m-d H:i:s';

  public function __construct($configuration) {
    $this->id = $configuration['id'];
    $this->name = $configuration['name'];
    $this->listType = $configuration['list_type'];
    $this->created = new \DateTime($configuration['created']);
    $this->updated = new \DateTime($configuration['updated']);
    $this->personCount = $configuration['person_count'];
  }

  public function getCreated() {
    return $this->created;
  }

  public function getId() {
    return $this->id;
  }

  public function getName() {
    return $this->name;
  }

  public function getListType() {
    return $this->listType;
  }

  public function getUpdated() {
    return $this->updated;
  }

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
