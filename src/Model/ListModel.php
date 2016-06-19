<?php

namespace Klaviyo\Model;

/**
 * Simple model for a Klaviyo "List".
 */
class ListModel extends BaseModel {

  protected $id;
  protected $name;
  protected $listType;
  protected $created;
  protected $updated;
  protected $personCount;
  protected static $mutableAttributes = ['name'];

  /**
   * {@inheritdoc}
   */
  public function __construct($configuration) {
    parent::__construct($configuration);

    $this->id = $configuration['id'];
    $this->name = $configuration['name'];
    $this->listType = !empty($configuration['list_type']) ? $configuration['list_type'] : 'standard';
    $this->created = new \DateTime($configuration['created']);
    $this->updated = new \DateTime($configuration['updated']);
    $this->personCount = $configuration['person_count'];
  }

  /**
   * {@inheritdoc}
   */
  public function jsonSerialize() {
    return parent::jsonSerialize() + [
      'id' => $this->id,
      'name' => $this->name,
      'list_type' => $this->listType,
      'created' => $this->created->format($this->dateFormat),
      'updated' => $this->updated->format($this->dateFormat),
      'person_count' => $this->personCount,
    ];
  }

}
