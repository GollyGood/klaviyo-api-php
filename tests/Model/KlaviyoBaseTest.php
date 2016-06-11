<?php

namespace Klaviyo\Tests\Model;

use Klaviyo\KlaviyoApi;
use Klaviyo\Model\KlaviyoModel;
use Klaviyo\Tests\KlaviyoTestCase;
use Psr\Http\Message\ResponseInterface;

abstract class KlaviyoBaseTest extends KlaviyoTestCase {

  protected $class = 'Klaviyo\Model\KlaviyoModel';
  protected $configuration = [];

  abstract public function assertModelMatchesConfiguration(KlaviyoModel $model, $configuration = array());

  public function testConstructor() {
    $model = new $this->class($this->configuration);
    $this->assertModelMatchesConfiguration($model);
  }

  public function testCreation() {
    $model = call_user_func("{$this->class}::create", $this->configuration);
    $this->assertModelMatchesConfiguration($model);
  }

  public function testCreationFromJson() {
    $model = call_user_func("{$this->class}::createFromJson", json_encode($this->configuration));
    $this->assertModelMatchesConfiguration($model);
  }

  public function testToJson() {
    $model = call_user_func("{$this->class}::create", $this->configuration);
    $this->assertEquals(json_encode($this->configuration), json_encode($model));
  }

}
