<?php

namespace Klaviyo\Tests\Model;

use Klaviyo\Model\ModelInterface;

class KlaviyoPersonReferenceTest extends KlaviyoBaseTest
{
    protected $class = 'Klaviyo\Model\PersonReferenceModel';
    protected $configuration;

    public function setUp()
    {
        $this->configuration = [
            'object' => 'person',
            'id' => 'dqQnNW',
            'email' => 'george.washington@example.com',
        ];
    }

    public function assertModelMatchesConfiguration(ModelInterface $person, $configuration = array())
    {
        if (empty($configuration)) {
            $configuration = $this->configuration;
        }

        $this->assertSame($configuration['object'], $person->objectType);
        $this->assertSame($configuration['id'], $person->id);
        $this->assertSame($configuration['email'], $person->email);
    }
}
