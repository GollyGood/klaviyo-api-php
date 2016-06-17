<?php

namespace Klaviyo\Model;

/**
 * Simple model for a Klaviyo "List" reference.
 */
class ListReferenceModel extends BaseModel {

  protected $id;
  protected $name;
  protected $listType;

  /**
   * {@inheritdoc}
   */
  public function __construct($configuration) {
    parent::__construct($configuration);

    $this->id = $configuration['id'];
    $this->name = $configuration['name'];
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
   * {@inheritdoc}
   */
  public function jsonSerialize() {
    return parent::jsonSerialize() + [
      'id' => $this->getId(),
      'name' => $this->getName(),
    ];
  }

}
