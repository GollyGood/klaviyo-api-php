<?php

namespace Klaviyo\Model;

/**
 * Simple model for a Klaviyo "Person and List".
 *
 * @property PersonReferenceModel $person;
 * @property ListReferenceModel $list
 * @property bool $alreadyMember
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

        $this->person = ModelFactory::create($configuration['person'], 'person_reference');
        $this->list = ModelFactory::create($configuration['list'], 'list_reference');
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
