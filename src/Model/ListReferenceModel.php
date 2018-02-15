<?php

namespace Klaviyo\Model;

/**
 * Simple model for a Klaviyo "List" reference.
 *
 * @property string $id
 * @property string $name
 */
class ListReferenceModel extends BaseModel
{
    protected $id;
    protected $name;
    protected $listType;

    /**
     * {@inheritdoc}
     */
    public function __construct($configuration)
    {
        parent::__construct($configuration);

        $this->id = $configuration['id'];
        $this->name = $configuration['name'];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return parent::jsonSerialize() + [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
