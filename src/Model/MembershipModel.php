<?php

namespace Klaviyo\Model;

/**
 * Simple model for a Klaviyo "Membership".
 *
 * @property string $email
 * @property \DateTimeInterface $dateAdded
 * @property PersonModel $person
 */
class MembershipModel extends BaseModel
{
    protected $email;
    protected $dateAdded;
    protected $person;

    /**
     * {@inheritdoc}
     */
    public function __construct($configuration)
    {
        parent::__construct($configuration);

        $this->email = $configuration['email'];
        $this->dateAdded = new \DateTime($configuration['date_added']);
        $this->person = PersonModel::create($configuration['person']);
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'email' => $this->email,
            'date_added' => $this->dateAdded->format($this->dateFormat),
            'person' => $this->person,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        return [
            'object' => $this->objectType,
            'email' => $this->email,
            'date_added' => $this->dateAdded->format($this->dateFormat),
            'person' => $this->person->toArray(),
        ];
    }
}
