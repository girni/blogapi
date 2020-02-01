<?php

namespace BlogApi\Core\Repositories\Criteria;

class Criteria
{
    /**
     * @var null
     */
    protected $value;

    public function __construct($value = null)
    {
        $this->value = $value;
    }
}
