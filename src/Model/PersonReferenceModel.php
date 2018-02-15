<?php

namespace Klaviyo\Model;

/**
 * Simple model for a Klaviyo "Person" reference.
 */
class PersonReferenceModel extends BaseModel
{
    protected $id;
    protected $email;

    /**
     * {@inheritdoc}
     */
    public function __construct($configuration)
    {
        parent::__construct($configuration);

        $this->id = $configuration['id'];
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
