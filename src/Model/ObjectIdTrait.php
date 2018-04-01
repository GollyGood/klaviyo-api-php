<?php

namespace Klaviyo\Model;

trait ObjectIdTrait
{
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
}
