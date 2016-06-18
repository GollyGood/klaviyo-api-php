<?php

namespace Klaviyo\Tests\Model;

use Klaviyo\KlaviyoApi;
use Klaviyo\Model\ModelInterface;
use Klaviyo\Model\PersonModel;
use Psr\Http\Message\ResponseInterface;

class KlaviyoPersonTest extends KlaviyoBaseTest {

  protected $class = 'Klaviyo\Model\PersonModel';
  protected $configuration;

  public function setUp() {
    $this->configuration = array(
      'object' => 'person',
      'id' => 'dqQnNW',
      '$email' => 'george.washington@example.com',
      '$first_name' => 'George',
      '$last_name' => 'Washington',
      '$organization' => 'U.S. Government',
      '$title' => 'President',
      '$city' => 'Mount Vernon',
      '$region' => 'Virginia',
      '$zip' => '22121',
      '$country' => 'United States',
      '$timezone' => 'US/Eastern',
      '$phone_number' => '',
      'foo' => 'bar',
      'baz' => 'bat',
    );
  }

  public function assertModelMatchesConfiguration(ModelInterface $person, $configuration = array()) {
    if (empty($configuration)) {
      $configuration = $this->configuration;
    }

    $this->assertSame($configuration['object'], $person->getObjectType());
    $this->assertSame($configuration['id'], $person->getId());
    $this->assertSame($configuration['$email'], $person->getEmail());
    $this->assertSame($configuration['$first_name'], $person->getFirstName());
    $this->assertSame($configuration['$last_name'], $person->getLastName());
    $this->assertSame($configuration['$organization'], $person->getOrganization());
    $this->assertSame($configuration['$title'], $person->getTitle());
    $this->assertSame($configuration['$city'], $person->getCity());
    $this->assertSame($configuration['$region'], $person->getRegion());
    $this->assertSame($configuration['$zip'], $person->getZip());
    $this->assertSame($configuration['$country'], $person->getCountry());
    $this->assertSame($configuration['$timezone'], $person->getTimezone());
    $this->assertSame($configuration['$phone_number'], $person->getPhoneNumber());
    $this->assertSame($configuration['foo'], $person->getCustomAttribute('foo'));
  }

  public function testToJson() {
    $model = call_user_func("{$this->class}::create", $this->configuration);

    // No object type when converting to Json b/c the API treats it as a custom
    // field...
    unset($this->configuration['object']);
    $this->assertEquals(json_encode($this->configuration), json_encode($model));
  }

  public function testGetCustomAttributes() {
    $model = call_user_func("{$this->class}::create", $this->configuration);
    $this->assertSame($this->configuration['foo'], $model->getCustomAttribute('foo'));
    $this->assertSame($this->configuration['baz'], $model->getCustomAttribute('baz'));
    $this->assertCount(2, $model->getAllCustomAttributes());
  }

}
