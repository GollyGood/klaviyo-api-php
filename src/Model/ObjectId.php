<?php

namespace Klaviyo\Model;

class ObjectId implements TemplateIdInterface, PersonIdInterface
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
}
