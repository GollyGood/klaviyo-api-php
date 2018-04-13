<?php

namespace Klaviyo\Model;

/**
 * Simple model for a Klaviyo recipient "Person" reference.
 *
 */
class RecipientPersonReferenceModel extends BaseModel
{
    use ObjectIdTrait;

    protected $id;
    protected $status;
    protected $email;
    protected $variation_id;

    protected $optionalDefault = [
      'variation_id' => '',
    ];

    /**
     * {@inheritdoc}
     */
    public function __construct($configuration)
    {
        parent::__construct($configuration);

        $this->setId($configuration['customer_id']);
        $this->status = $configuration['status'];
        $this->email = $configuration['email'];
        $this->variation_id = $configuration['variation_id'];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return parent::jsonSerialize() + [
          'customer_id' => $this->getId(),
          'status' => $this->status,
          'email' => $this->email,
          'variation_id' => $this->variation_id,
        ];
    }
}
