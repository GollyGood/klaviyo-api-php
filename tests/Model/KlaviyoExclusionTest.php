<?php

namespace Klaviyo\Tests\Model;

use Klaviyo\Model\ExclusionModel;
use Klaviyo\Model\ModelInterface;
use Klaviyo\Model\ModelFactory;

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

    public function testSetReasonsValid()
    {
        $exclusion = ModelFactory::create($this->configuration);
        $exclusion->setReason(ExclusionModel::REASON_UNSUBSCRIBED);
        $exclusion->setReason(ExclusionModel::REASON_BOUNCED);
        $exclusion->setReason(ExclusionModel::REASON_INVALID_EMAIL);
        $exclusion->setReason(ExclusionModel::REASON_REPORTED_SPAM);
        $exclusion->setReason(ExclusionModel::REASON_MANUALLY_EXCLUDED);
    }

    /**
     *  @expectedException Klaviyo\Exception\InvalidExclusionReasonException
     */
    public function testSetReasonsInvalid()
    {
        $exclusion = ModelFactory::create($this->configuration);
        $exclusion->setReason('invalid_reason');
    }

    /**
     *  @expectedException Klaviyo\Exception\InvalidExclusionReasonException
     */
    public function testCreateReasonInvalid()
    {
        $configuration = $this->configuration;
        $configuration['reason'] = 'invalid_reason';

        ModelFactory::create($configuration);
    }
}
