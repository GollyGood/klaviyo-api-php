<?php

namespace Klaviyo\Tests\Model;

use Klaviyo\Model\ModelInterface;

class KlaviyoRecipientPersonReferenceTest extends KlaviyoBaseTest
{
    protected $class = 'Klaviyo\Model\RecipientPersonReferenceModel';
    protected $configuration;

    public function setUp()
    {
        $this->configuration = [
            'object' => '',
            'customer_id' => 'dqQnNW',
            'status' => 'Sent',
            'email'  => 'abraham.lincoln@example.com',
            'variation_id' => ''
        ];
    }

    public function assertModelMatchesConfiguration(ModelInterface $recipientPerson, $configuration = array())
    {
        if (empty($configuration)) {
            $configuration = $this->configuration;
        }

        $this->assertSame($configuration['status'], $recipientPerson->status);
        $this->assertSame($configuration['customer_id'], $recipientPerson->id);
        $this->assertSame($configuration['email'], $recipientPerson->email);
        $this->assertSame($configuration['variation_id'], $recipientPerson->variation_id);
    }
}
