<?php

namespace Klaviyo\Model;

/**
 * Model to represent the response from excluding from a list.
 *
 * @param bool $alreadyExcluded
 * @param int $numExcluded
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
