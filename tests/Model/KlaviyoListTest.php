<?php

namespace Klaviyo\Tests\Model;

use Klaviyo\Model\ModelInterface;

class KlaviyoListTest extends KlaviyoBaseTest
{
    protected $class = 'Klaviyo\Model\ListModel';
    protected $configuration;

    public function setUp()
    {
        $this->configuration = array(
            'object' => 'segment',
            'id' => 'dqQnNW',
            'name' => 'Newsletter Subscribers',
            'list_type' => 'standard',
            'created' => '2013-06-10 13:00:00',
            'updated' => '2013-06-17 14:00:00',
            'person_count' => 1000,
            'folder' => null,
        );
    }

    public function assertModelMatchesConfiguration(ModelInterface $list, $configuration = array())
    {
        if (empty($configuration)) {
            $configuration = $this->configuration;
        }

        $this->assertSame($configuration['object'], $list->objectType);
        $this->assertSame($configuration['id'], $list->id);
        $this->assertSame($configuration['name'], $list->name);
        $this->assertSame($configuration['list_type'], $list->listType);

        $created = new \DateTime($configuration['created']);
        $this->assertEquals($created, $list->created);
        $updated = new \DateTime($configuration['updated']);
        $this->assertEquals($updated, $list->updated);

        $this->assertSame($configuration['person_count'], $list->personCount);
    }
}
