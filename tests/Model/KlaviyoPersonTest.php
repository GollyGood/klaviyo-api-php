<?php

namespace Klaviyo\Tests\Model;

use Klaviyo\Model\ModelInterface;
use Klaviyo\Model\PersonModel;

class KlaviyoPersonTest extends KlaviyoBaseTest
{
    protected $class = 'Klaviyo\Model\PersonModel';
    protected $configuration;

    public function setUp()
    {
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

    public function assertModelMatchesConfiguration(ModelInterface $person, $configuration = array())
    {
        if (empty($configuration)) {
            $configuration = $this->configuration;
        }

        $this->assertSame($configuration['object'], $person->objectType);
        $this->assertSame($configuration['id'], $person->id);
        $this->assertSame($configuration['$email'], $person->email);
        $this->assertSame($configuration['$first_name'], $person->firstName);
        $this->assertSame($configuration['$last_name'], $person->lastName);
        $this->assertSame($configuration['$organization'], $person->organization);
        $this->assertSame($configuration['$title'], $person->title);
        $this->assertSame($configuration['$city'], $person->city);
        $this->assertSame($configuration['$region'], $person->region);
        $this->assertSame($configuration['$zip'], $person->zip);
        $this->assertSame($configuration['$country'], $person->country);
        $this->assertSame($configuration['$timezone'], $person->timezone);
        $this->assertSame($configuration['$phone_number'], $person->phoneNumber);
        $this->assertSame($configuration['foo'], $person->getCustomAttribute('foo'));
        $this->assertSame($configuration['baz'], $person->getCustomAttribute('baz'));
    }

    public function testToJson()
    {
        $model = call_user_func("{$this->class}::create", $this->configuration);

        // No object type when converting to Json b/c the API treats it as a custom
        // field...
        unset($this->configuration['object']);
        $this->assertEquals(json_encode($this->configuration), json_encode($model));
    }

    public function testGetCustomAttributes()
    {
        $model = call_user_func("{$this->class}::create", $this->configuration);
        $this->assertSame($this->configuration['foo'], $model->getCustomAttribute('foo'));
        $this->assertSame($this->configuration['baz'], $model->getCustomAttribute('baz'));
        $this->assertCount(2, $model->getAllCustomAttributes());
    }

    public function testCreationFromJson()
    {
        $configuration = $this->configuration;
        // The API is returning these values as custom attributes when it really
        // probably should not.
        $configuration += [
            'email' => 'nothing@example.com',
            'first_name' => 'George',
            'last_name' => 'Washington',
        ];

        $model = call_user_func("{$this->class}::createFromJson", json_encode($configuration));
        $this->assertModelMatchesConfiguration($model);

        $this->assertArrayNotHasKey('email', $model->getAllCustomAttributes());
        $this->assertArrayNotHasKey('first_name', $model->getAllCustomAttributes());
        $this->assertArrayNotHasKey('last_name', $model->getAllCustomAttributes());
    }

    public function testUpdateFromArray()
    {
        $model = call_user_func("{$this->class}::create", $this->configuration);
        $updated_values = [
            '$first_name' => 'Thomas',
            '$last_name' => 'Jefferson',
            '$email' => 'thomas.jefferson@example.com',
            'foo' => 'bat',
            'yet' => 'another',
        ];
        $model->updateFromArray($updated_values);

        $updated_values += $this->configuration;
        $this->assertModelMatchesConfiguration($model, $updated_values);
    }

    public function testGetModelPropertyFromSpecialAttributeKey()
    {
        $this->assertSame('objectType', PersonModel::getModelPropertyFromSpecialAttributeKey('object'));
        $this->assertSame('id', PersonModel::getModelPropertyFromSpecialAttributeKey('id'));
        $this->assertSame('lastName', PersonModel::getModelPropertyFromSpecialAttributeKey('$last_name'));
        $this->assertSame('firstName', PersonModel::getModelPropertyFromSpecialAttributeKey('$first_name'));
    }

    /**
     * @expectedException Klaviyo\Exception\InvalidSpecialAttributeKeyException
     */
    public function testInvalidGetModelPropertyFromSpecialAttributeKey()
    {
        PersonModel::getModelPropertyFromSpecialAttributeKey('$someAwesomeAttribute');
    }

    public function testDeleteAttribute()
    {
        $person_configuration = $this->configuration;
        $model = call_user_func("{$this->class}::create", $person_configuration);
        $model->deleteAttribute('foo');

        unset($person_configuration['foo']);
        $person_configuration['$unset'] = ['foo'];
        $this->assertSame($person_configuration, $model->toArray());

        $person_configuration['$last_name'] = '';
        $person_configuration['$unset'] = ['foo', '$last_name'];
        $model->deleteAttribute('$last_name');
        $this->assertSame($person_configuration, $model->toArray());
    }

    /**
     * @expectedException Klaviyo\Exception\CannotDeleteRequiredSpecialAttributeKeyException
     */
    public function testInvalidDeleteRequiredModelProperty()
    {
        $person_configuration = $this->configuration;
        $model = call_user_func("{$this->class}::create", $person_configuration);
        $model->deleteAttribute('$email');
    }
}
