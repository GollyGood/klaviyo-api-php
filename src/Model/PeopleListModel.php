<?php

namespace Klaviyo\Model;

/**
 * Simple model for a Klaviyo "People and List".
 *
 * @property array $people;
 * @property ListReferenceModel $list
 */
class PeopleListModel extends BaseModel
{
    protected $people;
    protected $list;
    protected $alreadyMember;

    /**
     * {@inheritdoc}
     */
    public function __construct($configuration)
    {
        parent::__construct($configuration);
        $this->people = array_map(function($person) {
          return [
            'person' => ModelFactory::create($person['person'], 'person_reference'),
            'already_member' => $person['already_member'],
          ];
        }, $configuration['people']);
        $this->list = ModelFactory::create($configuration['list']);
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'people' => $this->people,
            'list' => $this->list,
        ];
    }
}
