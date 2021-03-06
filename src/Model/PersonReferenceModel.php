<?php

namespace Klaviyo\Model;

/**
 * Simple model for a Klaviyo "Person" reference.
 *
 * @property string $id
 * @property string $email
 */
class PersonReferenceModel extends BaseModel
{
    use ObjectIdTrait;

    protected $id;
    protected $email;

    /**
     * {@inheritdoc}
     */
    public function __construct($configuration)
    {
        parent::__construct($configuration);

        $this->setId($configuration['id']);
        $this->email = $configuration['email'];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return parent::jsonSerialize() + [
            'id' => $this->id,
            'email' => $this->email,
        ];
    }
}
