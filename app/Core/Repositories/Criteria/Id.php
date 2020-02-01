<?php

namespace BlogApi\Core\Repositories\Criteria;

use Illuminate\Database\Eloquent\Builder;

final class Id extends Criteria implements CriteriaInterface
{
    /**
     * @param Builder $query
     * @return Builder
     */
    public function apply(Builder $query): Builder
    {
        if($this->value === null) {
            return $query;
        }

        $query->where('id', $this->value);

        return $query;
    }
}
