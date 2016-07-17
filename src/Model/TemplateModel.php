<?php

namespace Klaviyo\Model;

/**
 * Simple model that represents a page.
 */
class TemplateModel extends BaseModel {

  protected $id;
  protected $name;
  protected $html;
  protected $created;
  protected $updated;
  protected static $optionalDefaults = [
    'name' => '',
    'created' => NULL,
    'updated' => NULL,
  ];

  /**
   * {@inheritdoc}
   */
  public function __construct($configuration) {
    parent::__construct($configuration);
    $configuration += self::$optionalDefaults;

    $this->id = $configuration['id'];
    $this->name = $configuration['name'];
    $dom = new \DOMDocument();
    $this->html = $dom::loadHTML($configuration['html'], LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    $this->created = !empty($configuration['created']) ? new \DateTime($configuration['created']) : NULL;
    $this->updated = !empty($configuration['created']) ? new \DateTime($configuration['updated']) : NULL;
  }

  /**
   * {@inheritdoc}
   */
  public function jsonSerialize() {
    return array_filter(parent::jsonSerialize() + [
      'id' => $this->id,
      'name' => $this->name,
      'html' => trim($this->html->saveHtml()),
      'created' => !empty($this->created) ? $this->created->format($this->dateFormat) : NULL,
      'updated' => !empty($this->updated) ? $this->updated->format($this->dateFormat) : NULL,
    ]);
  }

}
