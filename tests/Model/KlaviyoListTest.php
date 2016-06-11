<?php

namespace Klaviyo\Tests\Model;

use Klaviyo\KlaviyoApi;
use Klaviyo\Model\ListModel;
use Psr\Http\Message\ResponseInterface;

class KlaviyoListTest extends KlaviyoBaseTest {
  public $list_configuration;

  public function setUp() {
    $this->list_configuration = array(
      'id' => 'dqQnNW',
      'name' => 'Newsletter Subscribers',
      'list_type' => 'standard',
      'created' => '2013-06-10 13:00:00',
      'updated' => '2013-06-17 14:00:00',
      'person_count' => 1000
    );
  }

  public function assertListMatchesConfiguration(ListModel $list, $configuration = array()) {
    if (empty($configuration)) {
      $configuration = $this->list_configuration;
    }

    $this->assertSame($configuration['id'], $list->getId(), 'The id was not not correct.');
    $this->assertSame($configuration['name'], $list->getName(), 'The name was not correct.');
    $this->assertSame($configuration['list_type'], $list->getListType(), 'The list_type was not correct.');

    $created = new \DateTime($configuration['created']);
    $this->assertEquals($created, $list->getCreated(), 'The created date was not correct.');
    $updated = new \DateTime($configuration['updated']);
    $this->assertEquals($updated, $list->getUpdated(), 'The updated date was not correct.');

    $this->assertSame($configuration['person_count'], $list->getPersonCount());
  }

  public function testConstructor() {
    $list = new ListModel($this->list_configuration);
    $this->assertListMatchesConfiguration($list);
  }

  public function testCreation() {
    $list = ListModel::create($this->list_configuration);
    $this->assertListMatchesConfiguration($list);
  }

  public function testCreationFromJson() {
    $list = ListModel::createFromJson(json_encode($this->list_configuration));
    $this->assertListMatchesConfiguration($list);
  }

}
