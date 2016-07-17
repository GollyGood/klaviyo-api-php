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

  /**
   * {@inheritdoc}
   */
  public function __construct($configuration) {
    parent::__construct($configuration);

    $this->id = $configuration['id'];
    $this->name = $configuration['name'];
    $dom = new \DOMDocument();
    $this->html = $dom::loadHTML($configuration['html'], LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    $this->created = new \DateTime($configuration['created']);
    $this->updated = new \DateTime($configuration['updated']);
  }

  /**
   * {@inheritdoc}
   */
  public function jsonSerialize() {
    return parent::jsonSerialize() + [
      'id' => $this->id,
      'name' => $this->name,
      'html' => trim($this->html->saveHtml()),
      'created' => $this->created->format($this->dateFormat),
      'updated' => $this->updated->format($this->dateFormat),
    ];
  }

}
