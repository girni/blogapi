<?php

namespace BlogApi\Blog\Repositories\Eloquent;

use BlogApi\Blog\Model\Article;
use BlogApi\Blog\Repositories\ArticleRepositoryInterface;
use BlogApi\Core\Repositories\Eloquent\Repository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class ArticleRepository extends Repository implements ArticleRepositoryInterface
{
    /**
     * ArticleRepository constructor.
     * @param Article $model
     */
    public function __construct(Article $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int|null $limit
     * @return LengthAwarePaginator
     */
    public function findLatest(?int $limit = 10): LengthAwarePaginator
    {
        return $this->model
            ->orderByDesc('created_at')
            ->paginate($limit);
    }
}