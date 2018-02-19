<?php

namespace Klaviyo\Tests\Model;

use Klaviyo\Model\ModelInterface;

class KlaviyoEventTest extends KlaviyoBaseTest
{
    protected $class = 'Klaviyo\Model\EventModel';
    protected $configuration;

    public function setUp()
    {
        $this->configuration = [
            'event' => 'Elected President',
            'customer_properties' => [
                '$email' => 'thomas.jefferson@example.com'
            ],
            'properties' => [
                "PreviouslyVicePresident" => true,
                "YearElected" => 1801,
                "VicePresidents" => ["Aaron Burr", "George Clinton"]
            ],
            'time' => 1371477600,
        ];
    }

    public function assertModelMatchesConfiguration(ModelInterface $model, $configuration = array())
    {
        if (empty($configuration)) {
            $configuration = $this->configuration;
        }

        $this->assertSame($this->configuration['event'], $model->event);
        $this->assertEquals($this->configuration['customer_properties'], $model->customer_properties);
        $this->assertEquals($this->configuration['properties'], $model->properties);
        $time = new \DateTime('@'.$configuration['time']);
        $this->assertEquals($time, $model->time);
    }
}
