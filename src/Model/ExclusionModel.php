<?php

namespace Klaviyo\Model;

/**
 * @todo: Document
 */
class ExclusionModel extends BaseModel
{

    protected $timestamp;
    protected $reason;
    protected $email;

    /**
     * {@inheritdoc}
     */
    public function __construct($configuration)
    {
        parent::__construct($configuration);

        $this->timestamp = new \DateTime($configuration['timestamp']);
        $this->email = $configuration['email'];
        $this->reason = $configuration['reason'];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return parent::jsonSerialize() + [
            'timestamp' => $this->timestamp->format($this->dateFormat),
            'email' => $this->email,
            'reason' => $this->reason,
        ];
    }
}
