<?php

namespace Klaviyo\Tests\Model;

use Klaviyo\Model\ModelInterface;

class KlaviyoExclusionTest extends KlaviyoBaseTest
{
    protected $class = 'Klaviyo\Model\ExclusionModel';
    protected $configuration;

    public function setUp()
    {
        $this->configuration = [
            'object' => 'exclusion',
            'timestamp' => '2018-04-06 13:26:58',
            'email' => 'george.washington@example.com',
            'reason' => 'unsubscribed',
        ];
    }

    public function assertModelMatchesConfiguration(ModelInterface $exclusion, $configuration = array())
    {
        if (empty($configuration)) {
            $configuration = $this->configuration;
        }

        $this->assertSame($configuration['reason'], $exclusion->reason);
        $this->assertSame($configuration['object'], $exclusion->objectType);
        $timestamp = new \DateTime($configuration['timestamp']);
        $this->assertEquals($timestamp, $exclusion->timestamp);
        $this->assertEquals($configuration['email'], $exclusion->email);
    }
}
