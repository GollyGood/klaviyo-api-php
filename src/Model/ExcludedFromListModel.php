<?php

namespace Klaviyo\Model;

/**
 * @todo: Document
 */
class ExcludedFromListModel extends BaseModel
{
    protected $alreadyExcluded;
    protected $numExcluded;

    /**
     * {@inheritdoc}
     */
    public function __construct($configuration)
    {
        parent::__construct($configuration);

        $this->alreadyExcluded = $configuration['already_excluded'];
        $this->numExcluded = $configuration['num_excluded'];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return parent::jsonSerialize() + [
            'already_excluded' => $this->alreadyExcluded,
        ];
    }
}
