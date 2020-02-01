<?php

namespace BlogApi\Core\Repositories\Criteria;

use Illuminate\Database\Eloquent\Builder;

/**
 * Interface CriteriaInterface
 * @package App\Repositories\Contracts
 */
interface CriteriaInterface
{
    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function apply(Builder $query): Builder;
}
