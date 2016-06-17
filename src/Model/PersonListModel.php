<?php

namespace Klaviyo\Model;

/**
 * Simple model for a Klaviyo "Person and List".
 */
class PersonListModel extends BaseModel {

  protected $person;
  protected $list;
  protected $alreadyMember;

  /**
   * {@inheritdoc}
   */
  public function __construct($configuration) {
    parent::__construct($configuration);

    $this->person = PersonReferenceModel::create($configuration['person']);
    $this->list = ListReferenceModel::create($configuration['list']);
    $this->alreadyMember = $configuration['already_member'];
  }

  /**
   * Retrieve the person reference object.
   *
   * @return \Klaviyo\Model\PersonReferenceModel.
   *   The PersonReferenceModel retrieved from the Klaviyo API.
   */
  public function getPerson() {
    return $this->person;
  }

  /**
   * Retrieve the list reference object.
   *
   * @return \Klaviyo\Model\ListReferenceModel.
   *   The ListReferenceModel retrieved from the Klaviyo API.
   */
  public function getList() {
    return $this->list;
  }

  /**
   * Determine if the person is already a member of the list.
   *
   * @return bool
   *   Returns TRUE if the person is already a member of the list and FALSE
   *   otherwise.
   */
  public function isAlreadyMember() {
    return $this->alreadyMember;
  }

  /**
   * {@inheritdoc}
   */
  public function jsonSerialize() {
    return [
      'person' => $this->getPerson(),
      'list' => $this->getList(),
      'already_member' => $this->isAlreadyMember(),
    ];
  }

}
