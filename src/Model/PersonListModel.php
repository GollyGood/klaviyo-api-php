<?php

namespace Klaviyo\Model;

/**
 * Simple model for a Klaviyo "Person and List".
 */
class PersonListModel extends BaseModel
{
    protected $person;
    protected $list;
    protected $alreadyMember;

    /**
     * {@inheritdoc}
     */
    public function __construct($configuration)
    {
        parent::__construct($configuration);

        $this->person = PersonReferenceModel::create($configuration['person']);
        $this->list = ListReferenceModel::create($configuration['list']);
        $this->alreadyMember = $configuration['already_member'];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'person' => $this->person,
            'list' => $this->list,
            'already_member' => $this->alreadyMember,
        ];
    }
}
