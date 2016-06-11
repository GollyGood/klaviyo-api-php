<?php

namespace Klaviyo\Model;

class ListModel extends KlaviyoModel {

  protected $id;
  protected $name;
  protected $listType;
  protected $created;
  protected $updated;
  protected $personCount;

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

}
