<?php

namespace Klaviyo\Model;

use Klaviyo\Exception\InvalidExclusionReasonException;

/**
 * Model that represents an exclusion.
 *
 * @param \DateTime $timestamp
 * @param string $reason
 * @param email $email
 */
class ExclusionModel extends BaseModel
{
    const REASON_UNSUBSCRIBED = 'unsubscribed';
    const REASON_BOUNCED = 'bounced';
    const REASON_INVALID_EMAIL = 'invalid_email';
    const REASON_REPORTED_SPAM = 'reported_spam';
    const REASON_MANUALLY_EXCLUDED = 'manually_excluded';

    const SORT_ASC = 'asc';
    const SORT_DESC = 'asc';

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
        $this->setReason($configuration['reason']);
    }

    /**
     * {@inheritdoc}
     */
    public function __set($property, $value)
    {
        if ($property === 'reason') {
            return $this->setReason($value);
        } else {
            return parent::__set($property, $value);
        }
    }

    /**
     * Set the reason the user was excluded.
     *
     * @param string $value
     *   The reason the user was excluded.
     *
     * @return $this
     *
     * @throws InvalidExclusionReasonException
     */
    public function setReason($value)
    {
        $valid_reasons = [
            static::REASON_UNSUBSCRIBED,
            static::REASON_BOUNCED,
            static::REASON_INVALID_EMAIL,
            static::REASON_REPORTED_SPAM,
            static::REASON_MANUALLY_EXCLUDED,
        ];

        if (in_array($value, $valid_reasons)) {
            $this->reason = $value;
        } else {
            throw new InvalidExclusionReasonException(
                sprintf(
                    '"%s" is not a valid reason. Only %s reasons are valid.',
                    $value,
                    implode(', ', $valid_reasons)
                )
            );
        }

        return $this;
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
