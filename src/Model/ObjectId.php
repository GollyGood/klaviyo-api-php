<?php

namespace Klaviyo\Model;

class ObjectId implements TemplateIdInterface, PersonIdInterface
{
    use ObjectIdTrait;

    protected $id;

    public function __construct($id)
    {
        $this->setId($id);
    }
}
