<?php

namespace Klaviyo\Model;

/**
 * Simple model that represents a campaign.
 */
class CampaignModel extends BaseModel {

  protected $id;
  protected $name;
  protected $subject;
  protected $fromEmail;
  protected $fromName;
  protected $listId;
  protected $template;
  protected $status;
  protected $sentAt;
  protected $created;

  /**
   * {@inheritdoc}
   */
  public function __construct($configuration) {
    parent::__construct($configuration);

    $this->id = $configuration['id'];
    $this->name = $configuration['name'];
    $this->subject = $configuration['subject'];
    $this->fromEmail = $configuration['from_email'];
    $this->fromName = $configuration['from_name'];
    // @todo: This needs to be transformed into an array of lists as the
    // property lists. The documented API is incorrect.
    $this->listId = $configuration['list_id'];
    $this->template = TemplateModel::create($configuration['template']);
    $this->status = $configuration['status'];
    $this->sentAt = $configuration['sent_at'];
    $this->created = new \DateTime($configuration['created']);
  }

  /**
   * {@inheritdoc}
   */
  public function jsonSerialize() {
    return parent::jsonSerialize() + [
      'id' => $this->id,
      'name' => $this->name,
      'subject' => $this->subject,
      'from_email' => $this->fromEmail,
      'from_name' => $this->fromName,
      'list_id' => $this->listId,
      'template' => $this->template,
      'status' => $this->status,
      'sent_at' => $this->sentAt,
      'created' => $this->created->format($this->dateFormat),
    ];
  }

}
