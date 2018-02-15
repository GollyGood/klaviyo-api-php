<?php

namespace Klaviyo\Tests\Model;

use Klaviyo\Model\ModelInterface;
use Klaviyo\Model\RenderedTemplateModel;

class KlaviyoRenderedTemplateTest extends KlaviyoBaseTest
{
    protected $class = RenderedTemplateModel::class;
    protected $configuration;

    public function setUp()
    {
        $this->configuration = [
            'object' => 'rendered-template',
            'id' => 'dqQnNW',
            'name' => 'My New Template',
            'data' => [
                'text' => "This is an email for {{ email }}.",
                'html' => '<html><body><p>This is an email for {{ email }}.</p></body></html>',
            ]
        ];
    }

    public function assertModelMatchesConfiguration(ModelInterface $model, $configuration = array())
    {
        if (empty($configuration)) {
            $configuration = $this->configuration;
        }

        /** @var RenderedTemplateModel $model */
        $this->assertSame($this->configuration['object'], $model->objectType);
        $this->assertSame($this->configuration['id'], $model->id);
        $this->assertSame($this->configuration['name'], $model->name);
        $this->assertSame($this->configuration['data']['text'], $model->text);
        $this->assertSame($this->configuration['data']['html'], $model->html);
    }
}
