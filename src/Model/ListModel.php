<?php

namespace Klaviyo\Model;

/**
 * Simple model for a Klaviyo "List".
 */
class ListModel extends BaseModel
{
    protected $id;
    protected $name;
    protected $listType;
    protected $created;
    protected $updated;
    protected $personCount;
    protected static $mutableAttributes = ['name'];
    protected static $optionalDefaults = [
        'object' => 'list',
        'id' => '',
        'name' => '',
        'list_type' => 'list',
        'created' => null,
        'updated' => null,
        'person_count' => 0,
        'folder' => null,
    ];

    /**
     * {@inheritdoc}
     */
    public function __construct($configuration)
    {
        parent::__construct($configuration);

        $this->id = $configuration['id'];
        $this->name = $configuration['name'];
        $this->listType = $configuration['list_type'];
        $this->created = new \DateTime($configuration['created']);
        $this->updated = new \DateTime($configuration['updated']);
        $this->personCount = $configuration['person_count'];
        $this->folder = $configuration['folder'];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return parent::jsonSerialize() + [
            'id' => $this->id,
            'name' => $this->name,
            'list_type' => $this->listType,
            'created' => $this->created->format($this->dateFormat),
            'updated' => $this->updated->format($this->dateFormat),
            'person_count' => $this->personCount,
            'folder' => $this->folder,
        ];
    }
}
