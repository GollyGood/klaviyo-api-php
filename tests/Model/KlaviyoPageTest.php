<?php

namespace Klaviyo\Tests\Model;

use Klaviyo\KlaviyoApi;
use Klaviyo\Model\ModelInterface;

class KlaviyoPageTest extends KlaviyoBaseTest
{
    protected $class = 'Klaviyo\Model\PageModel';
    protected $configuration;

    public function setUp()
    {
        $this->configuration = [
            'object' => '$list',
            'start' => 0,
            'end' => 0,
            'page_size' => 0,
            'total' => 0,
            'page' => 0,
            'data' => [],
        ];
    }

    public function assertModelMatchesConfiguration(ModelInterface $model, $configuration = array())
    {
        if (empty($configuration)) {
            $configuration = $this->configuration;
        }

        $this->assertSame(KlaviyoApi::$dataMap[$this->configuration['object']], $model->objectType);
        $this->assertSame($this->configuration['start'], $model->start);
        $this->assertSame($this->configuration['end'], $model->end);
        $this->assertSame($this->configuration['page_size'], $model->pageSize);
        $this->assertSame($this->configuration['total'], $model->total);
        $this->assertSame($this->configuration['page'], $model->page);
        $this->assertSame($this->configuration['data'], $model->data);
    }
}
