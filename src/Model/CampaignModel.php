<?php

namespace Klaviyo\Model;

/**
 * Simple model that represents a campaign.
 *
 * @property string $id
 * @property string $name
 * @property string $subject
 * @property string $fromEmail
 * @property string $fromName
 * @property string $lists
 * @property TemplateModel $template
 * @property string $status
 * @property string $statusId
 * @property string $statusLabel
 * @property string $sentAt
 * @property string $sendTime
 * @property \DateTimeInterface $created
 * @property \DateTimeInterface $updated
 * @property string $numRecipients
 * @property string $isSegmented
 * @property string $campaignType
 */
class CampaignModel extends BaseModel implements CampaignIdInterface
{
    use ObjectIdTrait;

    public $name;
    public $subject;
    public $fromEmail;
    public $fromName;
    public $lists;
    public $template;
    public $useSmartSending;
    public $addGoogleAnalytics;

    protected $id;
    protected $status;
    protected $statusId;
    protected $statusLabel;
    protected $sentAt;
    protected $sendTime;
    protected $created;
    protected $updated;
    protected $numRecipients;
    protected $isSegmented;
    protected $campaignType;
    protected $templateId;
    protected static $optionalDefaults = [
        'id' => '',
        'status' => 'draft',
        'status_id' => 2,
        'status_label' => 'Draft',
        'send_time' => '',
        'updated' => null,
        'num_recipients' => 0,
        'is_segmented' => false,
        'campaign_type' => 'Regular',
        'template' => null,
        'template_id' => 0,
    ];

    /**
     * {@inheritdoc}
     */
    public function __construct($configuration)
    {
        parent::__construct($configuration);

        $this->setId($configuration['id']);
        $this->name = $configuration['name'];
        $this->subject = $configuration['subject'];
        $this->fromEmail = $configuration['from_email'];
        $this->fromName = $configuration['from_name'];
        $this->status = $configuration['status'];
        $this->statusId = $configuration['status_id'];
        $this->statusLabel = $configuration['status_label'];
        $this->sentAt = $configuration['sent_at'];
        $this->sendTime = $configuration['send_time'];
        $this->created = new \DateTime($configuration['created']);
        $this->updated = !empty($configuration['updated']) ? new \DateTime($configuration['updated']) : null;
        $this->numRecipients = $configuration['num_recipients'];
        $this->isSegmented = $configuration['is_segmented'];
        $this->campaignType = $configuration['campaign_type'];

        $this->loadTemplate($configuration);
        $this->loadLists($configuration['lists']);
    }

    /**
     * Load the template associated with the campaign.
     *
     * @param array $configuration
     *     An array of configuration values.
     *
     * @return $this
     */
    public function loadTemplate($configuration)
    {
        if (isset($configuration['template'])) {
            $template = is_subclass_of($configuration['template'], BaseModel::class) ?
                                $configuration['template'] :
                                TemplateModel::create($configuration['template']);
            $this->setTemplate($template);
        } else {
            $this->setTemplateId(new ObjectId($configuration['template_id']));
        }

        return $this;
    }

    /**
     * Set the template and template id to associate with the campaign.
     *
     * @param TemplateModel $template
     *    The template that should be associated with the campaign.
     *
     * @return $this
     */
    public function setTemplate(TemplateModel $template)
    {
        $this->template = $template;
        $this->templateId = $template->getId();
        return $this;
    }

    /**
     * Set the template id and remove the template to associate with the campaign.
     *
     * @param TemplateIdInterface $id
     *    The template id to associate with the campaign.
     *
     * @return $this
     */
    public function setTemplateId(TemplateIdInterface $id)
    {
        $this->template = null;
        $this->templateId = $id->getId();
        return $this;
    }

    /**
     * Load the lists associated with the campaign.
     *
     * @param array $lists
     *   An array of lists associated with the campaign.
     *
     * @return $this
     */
    protected function loadLists($lists)
    {
        $this->lists = [];

        foreach ($lists as $list) {
            $this->lists[] = is_subclass_of($list, BaseModel::class) ? $list : ListModel::create($list);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return parent::jsonSerialize() + [
            'id' => $this->getId(),
            'name' => $this->name,
            'subject' => $this->subject,
            'from_email' => $this->fromEmail,
            'from_name' => $this->fromName,
            'lists' => $this->lists,
            'template' => $this->template,
            'status' => $this->status,
            'status_id' => $this->statusId,
            'status_label' => $this->statusLabel,
            'sent_at' => $this->sentAt,
            'send_time' => $this->sendTime,
            'created' => $this->created->format($this->dateFormat),
            'updated' => !empty($this->updated) ? $this->updated->format($this->dateFormat) : null,
            'num_recipients' => $this->numRecipients,
            'is_segmented' => $this->isSegmented,
            'campaign_type' => $this->campaignType,
        ];
    }
}
