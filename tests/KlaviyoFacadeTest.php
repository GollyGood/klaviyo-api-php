<?php

namespace Klaviyo\Tests;

use Klaviyo\KlaviyoFacade;
use Klaviyo\ListService;
use Klaviyo\Model\EmptyModel;
use Klaviyo\Model\ListModel;
use Klaviyo\Model\PersonModel;
use Klaviyo\PersonService;
use Klaviyo\TrackService;

class KlaviyoFacadeTest extends KlaviyoTestCase
{
    protected $klaviyo;

    public function setup()
    {
        $this->klaviyo = KlaviyoFacade::create($this->apiKey);
    }

    public function testServiceCreation()
    {
        $this->assertInstanceOf(ListService::class, $this->klaviyo->service('lists'));
        $this->assertInstanceOf(PersonService::class, $this->klaviyo->service('person'));
        $this->assertInstanceOf(TrackService::class, $this->klaviyo->service('track'));
    }

    /**
     * @expectedException Klaviyo\Exception\ServiceNotFoundException
     */
    public function testServiceNotFound()
    {
        $this->klaviyo->service('does-not-exist');
    }

    /**
     * @expectedException Klaviyo\Exception\IsNotAServiceException
     */
    public function testIsNotAService()
    {
        $this->klaviyo->service('model.factory');
    }

    public function testServiceCreationModelFactory()
    {
        $this->assertInstanceOf(EmptyModel::class, $this->klaviyo->model());
        $this->assertInstanceOf(EmptyModel::class, $this->klaviyo->modelFromJson());
        $person_configuration = ['object' => 'person', '$email' => 'nothing@example.com', '$first_name' => 'John'];
        $this->assertInstanceOf(PersonModel::class, $this->klaviyo->model($person_configuration));
        $this->assertInstanceOf(PersonModel::class, $this->klaviyo->modelFromJson(json_encode($person_configuration), 'person'));
        $this->assertInstanceOf(ListModel::class, $this->klaviyo->model(['id' => 'abc', 'name' => 'Abc', 'list_type' => 'list', 'created' => '03/14/1592', 'updated' => '03/14/1592', 'person_count' => 0], 'list'));
    }

    public function testGetModelClass()
    {
        $this->assertSame(PersonModel::class, $this->klaviyo->getModelClass('person'));
        $this->assertSame(EmptyModel::class, $this->klaviyo->getModelClass('abc'));
    }
}
