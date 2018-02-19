<?php

namespace Klaviyo\Model;

/**
 * Class EventModel
 *
 * @property-read string $event;
 * @property-read array $customer_properties
 * @property-read array $properties
 * @property-read \DateTimeImmutable $time
 */
class EventModel extends BaseModel
{
    /**
     * @var string
     */
    protected $event;

    /**
     * @var array
     */
    protected $customer_properties = [];

    /**
     * @var array
     */
    protected $properties = [];

    /**
     * @var \DateTimeInterface
     */
    protected $time;

    protected static $optionalDefaults = [
        'properties' => null,
        'time' => null,
    ];

    /**
     * {@inheritdoc}
     */
    public function __construct($configuration)
    {
        if (!isset($configuration['customer_properties']['$email']) &&
            !isset($configuration['customer_properties']['$id'])
        ) {
            throw new \BadMethodCallException('customer_properties must contain $id or $email');
        }

        parent::__construct($configuration);
        $configuration += self::$optionalDefaults;

        $this->event = $configuration['event'];
        $this->customer_properties = $configuration['customer_properties'];
        $this->properties = $configuration['properties'];
        $this->time = !empty($configuration['time']) ?
            new \DateTimeImmutable(
                is_int($configuration['time']) ? '@'.$configuration['time'] : $configuration['time']
            ) : null;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return array_filter(parent::jsonSerialize() + [
                'event' => $this->event,
                'customer_properties' => $this->customer_properties,
                'properties' => $this->properties,
                'time' => !empty($this->time) ? $this->time->getTimestamp() : null,
            ]);
    }
}
