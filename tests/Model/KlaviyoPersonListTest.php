<?php

namespace Klaviyo\Tests\Model;

use Klaviyo\KlaviyoApi;
use Klaviyo\Model\ModelInterface;
use Klaviyo\Model\PersonListModel;
use Klaviyo\Model\PersonReferenceModel;
use Klaviyo\Model\ListReferenceModel;

class KlaviyoPersonListTest extends KlaviyoBaseTest {

  protected $class = 'Klaviyo\Model\PersonListModel';
  protected $configuration;

  public function setUp() {
    $this->configuration = [
      'person' => [
        'object' => 'person',
        'id' => 'dqQnNW',
        'email' => 'george.washington@example.com',
      ],
      'list' => [
        'object' => 'list',
        'id' => 'dqQnNW',
        'name' => 'Newsletter Subscribers'
      ],
      'already_member' => FALSE,
    ];
  }

  public function assertModelMatchesConfiguration(ModelInterface $person_list, $configuration = array()) {
    if (empty($configuration)) {
      $configuration = $this->configuration;
    }

    $person = PersonReferenceModel::create($configuration['person']);
    $this->assertEquals($person, $person_list->person);
    $list = ListReferenceModel::create($configuration['list']);
    $this->assertEquals($list, $person_list->list);
    $this->assertFalse($person_list->alreadyMember);
  }

}
