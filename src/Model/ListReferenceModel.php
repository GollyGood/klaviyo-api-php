<?php

namespace Klaviyo\Model;

/**
 * Simple model for a Klaviyo "List" reference.
 *
 * @property string $id
 * @property string $name
 */
class ListReferenceModel extends BaseModel implements IdInterface
{
    use ObjectIdTrait;

    protected $id;
    protected $name;
    protected $listType;

    /**
     * {@inheritdoc}
     */
    public function __construct($configuration)
    {
        parent::__construct($configuration);

        $this->setId($configuration['id']);
        $this->name = $configuration['name'];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return parent::jsonSerialize() + [
            'id' => $this->getId(),
            'name' => $this->name,
        ];
    }
}
