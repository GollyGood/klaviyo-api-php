<?php

namespace Klaviyo\Tests\Model;

use Klaviyo\Model\EmptyModel;
use Klaviyo\Model\ModelFactory;
use Klaviyo\Model\PersonModel;
use Klaviyo\Tests\KlaviyoTestCase;

class KlaviyoFactoryTest extends KlaviyoTestCase
{
    public function testGetModelMap()
    {
        $this->assertCount(9, ModelFactory::getModelMap());

        foreach (ModelFactory::getModelMap() as $model_name => $model_class) {
            $this->assertTrue(strpos($model_class, 'Klaviyo\Model') !== false);
        }
    }

    public function testModelCreation()
    {
        $this->assertInstanceOf(EmptyModel::class, ModelFactory::create([]));

        $person_configuration = ['$email' => 'nothing@example.com', '$first_name' => 'nothing'];
        $person = ModelFactory::create($person_configuration, 'person');
        $this->assertInstanceOf(PersonModel::class, $person);
        $person_json = ModelFactory::createFromJson(json_encode($person_configuration), 'person');
        $this->assertInstanceOf(PersonModel::class, $person_json);
        $this->assertEquals($person, $person_json);

        $person_1 = ModelFactory::callModelCreationMethod('create', $person_configuration, 'person');
        $this->assertInstanceOf(PersonModel::class, $person_1);
        $this->assertEquals($person, $person_1);

        $person_json_1 = ModelFactory::callModelCreationMethod('createFromJson', json_encode($person_configuration), 'person');
        $this->assertInstanceOf(PersonModel::class, $person_json_1);
        $this->assertEquals($person_json, $person_json_1);
    }

    /**
     * @expectedException Klaviyo\Exception\MissingModelTypeException
     */
    public function testMissingModelTypeException()
    {
        $person_configuration = ['$email' => 'nothing@example.com', '$first_name' => 'nothing'];
        ModelFactory::getModelType($person_configuration);
    }

    public function testGetModelType()
    {
        $person_configuration = ['$email' => 'nothing@example.com', '$first_name' => 'nothing'];
        $this->assertSame('person', ModelFactory::getModelType($person_configuration + ['object' => 'person']));
        $this->assertSame('person', ModelFactory::getModelType($person_configuration, 'person'));
        $this->assertSame('', ModelFactory::getModelType([]));
    }
}
