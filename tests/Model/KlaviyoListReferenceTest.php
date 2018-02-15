<?php

namespace Klaviyo\Tests\Model;

use Klaviyo\Model\ModelInterface;

class KlaviyoListReferenceTest extends KlaviyoBaseTest
{
    protected $class = 'Klaviyo\Model\ListReferenceModel';
    protected $configuration;

    public function setUp()
    {
        $this->configuration = [
            'object' => 'list',
            'id' => 'dqQnNW',
            'name' => 'Newsletter Subscribers',
        ];
    }

    public function assertModelMatchesConfiguration(ModelInterface $list, $configuration = array())
    {
        if (empty($configuration)) {
            $configuration = $this->configuration;
        }

        $this->assertSame($configuration['object'], $list->objectType);
        $this->assertSame($configuration['id'], $list->id);
        $this->assertSame($configuration['name'], $list->name);
    }
}
