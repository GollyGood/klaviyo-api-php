<?php

namespace Klaviyo\Model;

/**
 * Class RenderedTemplateModel
 *
 * @property string $id
 * @property string $name
 * @property string $text
 * @property string $html
 */
class RenderedTemplateModel extends BaseModel
{
    protected $id;
    protected $name;
    protected $html;
    protected $text;

    /**
     * {@inheritdoc}
     */
    public function __construct($configuration)
    {
        parent::__construct($configuration);

        $this->id = $configuration['id'];
        $this->name = $configuration['name'];
        $this->text = $configuration['data']['text'];
        $this->html = $configuration['data']['html'];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return array_filter(parent::jsonSerialize() + [
                'id' => $this->id,
                'name' => $this->name,
                'data' => [
                    'text' => $this->text,
                    'html' => $this->html,
                ]
            ]);
    }
}
