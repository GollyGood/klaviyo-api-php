<?php

namespace Klaviyo\Tests\Model;

use Klaviyo\Model\ModelInterface;
use Klaviyo\Tests\KlaviyoTestCase;

abstract class KlaviyoBaseTest extends KlaviyoTestCase
{
    protected $class = 'Klaviyo\Model\BaseModel';
    protected $configuration = [];

    abstract public function assertModelMatchesConfiguration(ModelInterface $model, $configuration = array());

    public function testConstructor()
    {
        $model = new $this->class($this->configuration);
        $this->assertModelMatchesConfiguration($model);
    }

    public function testCreation()
    {
        $model = call_user_func("{$this->class}::create", $this->configuration);
        $this->assertModelMatchesConfiguration($model);
    }

    public function testCreationFromJson()
    {
        $model = call_user_func("{$this->class}::createFromJson", json_encode($this->configuration));
        $this->assertModelMatchesConfiguration($model);
    }

    public function testToJson()
    {
        $model = call_user_func("{$this->class}::create", $this->configuration);
        $this->assertEquals(json_encode($this->configuration), json_encode($model));
    }

    public function testToArray()
    {
        $model = call_user_func("{$this->class}::create", $this->configuration);
        $this->assertEquals($this->configuration, $model->toArray());
    }
}
