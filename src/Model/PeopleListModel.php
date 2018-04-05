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
            // @todo: It was expected based on the api that this was a person
            //        reference, however, it was simply an email.
            'email' => $person['email'],
            'already_member' => $person['already_member'],
          ];
        }, $configuration['people']);
        $this->list = ModelFactory::create($configuration['list'], 'list_reference');
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
