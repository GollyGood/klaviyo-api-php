<?php

namespace Klaviyo\Model;

/**
 * Simple model that represents a template.
 *
 * @property string $id
 * @property string $name
 * @property \DOMDocument $html
 * @property \DateTimeInterface $created
 * @property \DateTimeInterface $updated
 */
class TemplateModel extends BaseModel implements TemplateIdInterface
{
    protected $id;
    protected $name;
    protected $html;
    protected $created;
    protected $updated;
    protected static $optionalDefaults = [
        'name' => '',
        'created' => null,
        'updated' => null,
    ];
    protected static $mutableAttributes = [
        'html',
    ];

    /**
     * {@inheritdoc}
     */
    public function __construct($configuration)
    {
        parent::__construct($configuration);
        $configuration += self::$optionalDefaults;

        $this->id = $configuration['id'];
        $this->name = $configuration['name'];
        $this->created = !empty($configuration['created']) ? new \DateTime($configuration['created']) : null;
        $this->updated = !empty($configuration['created']) ? new \DateTime($configuration['updated']) : null;
        $this->setHtml($configuration['html']);
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
     * Retrieve an HTML object from the specified string.
     *
     * @param string $content
     *   The valid HTML to transform into an HTML object.
     *
     * @return \DOMDocument
     *   The HTML object that may used to manipulate the DOM.
     */
    public function getHtmlObjectFromString(string $content): \DOMDocument
    {
        $dom = new \DOMDocument();
        @$dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        return $dom;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return array_filter(parent::jsonSerialize() + [
            'id' => $this->id,
            'name' => $this->name,
            'html' => trim($this->html->saveHtml()),
            'created' => !empty($this->created) ? $this->created->format($this->dateFormat) : null,
            'updated' => !empty($this->updated) ? $this->updated->format($this->dateFormat) : null,
        ]);
    }

    public function getId(): string
    {
        return $this->id;
    }
}
