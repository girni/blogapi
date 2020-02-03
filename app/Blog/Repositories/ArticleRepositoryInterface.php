<?php

namespace BlogApi\Blog\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ArticleRepositoryInterface
{
    public function findLatest(?int $limit = 10): LengthAwarePaginator;
}