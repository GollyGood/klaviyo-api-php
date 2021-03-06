<?php

namespace Klaviyo\Model;

/**
 * Simple model for a Klaviyo "List".
 *
 * @property string $id
 * @property string $name
 * @property string $listType
 * @property \DateTimeInterface $created
 * @property \DateTimeInterface $updated
 * @property string $personCount
 */
class ListModel extends BaseModel implements ListIdInterface
{
    use ObjectIdTrait;

    public $name;

    protected $id;
    protected $listType;
    protected $created;
    protected $updated;
    protected $personCount;
    protected $folder;
    protected static $optionalDefaults = [
        'object' => 'list',
        'id' => '',
        'name' => '',
        'list_type' => 'list',
        'created' => null,
        'updated' => null,
        'person_count' => 0,
        'folder' => '',
    ];

    /**
     * {@inheritdoc}
     */
    public function __construct($configuration)
    {
        parent::__construct($configuration);

        $this->setId($configuration['id']);
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
            'id' => $this->getId(),
            'name' => $this->name,
            'list_type' => $this->listType,
            'created' => $this->created->format($this->dateFormat),
            'updated' => $this->updated->format($this->dateFormat),
            'person_count' => $this->personCount,
            'folder' => $this->folder,
        ];
    }
}
