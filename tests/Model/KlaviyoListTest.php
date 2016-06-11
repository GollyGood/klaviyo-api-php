<?php

namespace Klaviyo\Tests\Model;

use Klaviyo\KlaviyoApi;
use Klaviyo\Model\KlaviyoModel;
use Klaviyo\Model\ListModel;
use Psr\Http\Message\ResponseInterface;

class KlaviyoListTest extends KlaviyoBaseTest {
  protected $class = 'Klaviyo\Model\ListModel';
  protected $configuration;

  public function setUp() {
    $this->configuration = array(
      'id' => 'dqQnNW',
      'name' => 'Newsletter Subscribers',
      'list_type' => 'standard',
      'created' => '2013-06-10 13:00:00',
      'updated' => '2013-06-17 14:00:00',
      'person_count' => 1000
    );
  }

  public function assertModelMatchesConfiguration(KlaviyoModel $list, $configuration = array()) {
    if (empty($configuration)) {
      $configuration = $this->configuration;
    }

    $this->assertSame($configuration['id'], $list->getId());
    $this->assertSame($configuration['name'], $list->getName());
    $this->assertSame($configuration['list_type'], $list->getListType());

    $created = new \DateTime($configuration['created']);
    $this->assertEquals($created, $list->getCreated());
    $updated = new \DateTime($configuration['updated']);
    $this->assertEquals($updated, $list->getUpdated());

    $this->assertSame($configuration['person_count'], $list->getPersonCount());
  }

}
