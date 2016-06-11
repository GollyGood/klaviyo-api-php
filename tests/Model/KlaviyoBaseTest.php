<?php

namespace Klaviyo\Tests\Model;

use Klaviyo\KlaviyoApi;
use Klaviyo\Model\KlaviyoModel;
use Klaviyo\Tests\KlaviyoTestCase;
use Psr\Http\Message\ResponseInterface;

class KlaviyoBaseTest extends KlaviyoTestCase {

  public function testConstructor() {
    $model = new KlaviyoModel([]);
  }

  public function testCreation() {
    $model = KlaviyoModel::create([]);
  }

  public function testCreationFromJson() {
    $model = KlaviyoModel::createFromJson(json_encode([]));
  }

  public function testToArray() {
    $configuration = ['one' => 'two', 'three' => 'four'];
    $model = KlaviyoModel::create($configuration);
    $this->assertSame($configuration, (array) $model);
  }

  public function testToJson() {
    $configuration = ['one' => 'two', 'three' => 'four'];
    $model = KlaviyoModel::create($configuration);
    $this->assertEquals(json_encode($configuration), json_encode($model));
  }

}
