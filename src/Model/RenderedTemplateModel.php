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
        $this->setHtml($configuration['data']['html']);
        $this->objectType = 'rendered-template';
    }

    /**
     * {@inheritdoc}
     */
    public function __set($property, $value)
    {
        if ($property === 'html') {
            return $this->setHtml($value);
        } else {
            return parent::__set($property, $value);
        }
    }

    /**
     * Set the html value.
     *
     * @param \DOMDocument|string $value
     *   The HTML for the template. The value may be either a string or a
     *   DOMDocument.
     *
     * @return $this
     */
    public function setHtml($value)
    {
        if (is_string($value)) {
            $value = $this->getHtmlObjectFromString($value);
        }

        if (!($value instanceof \DOMDocument)) {
            throw new \InvalidArgumentException('"html" must be set as a valid DOMDocument object.');
        }
        $this->html = $value;

        return $this;
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
                    'html' => trim($this->html->saveHtml()),
                ]
            ]);
    }
}
