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
    use ObjectIdTrait;

    protected $id;
    protected $name;
    protected $created;
    protected $updated;
    public $html;
    protected static $optionalDefaults = [
        'name' => '',
        'created' => null,
        'updated' => null,
    ];

    /**
     * {@inheritdoc}
     */
    public function __construct($configuration)
    {
        parent::__construct($configuration);
        $configuration += self::$optionalDefaults;

        $this->setId($configuration['id']);
        $this->name = $configuration['name'];
        $this->created = !empty($configuration['created']) ? new \DateTime($configuration['created']) : null;
        $this->updated = !empty($configuration['updated']) ? new \DateTime($configuration['updated']) : null;

        $this->setHtml($configuration['html']);
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
            'id' => $this->getId(),
            'name' => $this->name,
            'html' => trim($this->html->saveHtml()),
            'created' => !empty($this->created) ? $this->created->format($this->dateFormat) : null,
            'updated' => !empty($this->updated) ? $this->updated->format($this->dateFormat) : null,
        ]);
    }

    public function getId()
    {
        return $this->id;
    }
}
