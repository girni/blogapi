<?php

namespace BlogApi\Core\Repositories;

use BlogApi\Core\Repositories\Criteria\CriteriaInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface EloquentRepositoryInterface
{
    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * @param $id
     *
     * @return Model
     */
    public function find($id): ?Model;

    /**
     * @param Model $model
     * @param array $attributes
     *
     * @return Model
     */
    public function update(Model $model, array $attributes): Model;

    /**
     * @param array $attributes
     * @param array $values
     *
     * @return Model
     */
    public function updateOrCreate(array $attributes, array $values = []): Model;

    /**
     * @param array $data
     *
     * @return bool
     */
    public function insert(array $data): bool;

    /**
     * @param Model $model
     *
     * @return bool
     */
    public function delete(Model $model): bool;

    /**
     * @return Collection
     */
    public function findAll(): Collection;

    /**
     * @param array $criteria
     * @param Builder|null $builder
     * @return Builder
     */
    public function buildQueryByCriteria(array $criteria, ?Builder $builder = null): Builder;

    /**
     * @param CriteriaInterface[] $criteria
     *
     * @param Builder|null $builder
     * @return Collection
     */
    public function findByCriteria(array $criteria, ?Builder $builder = null): Collection;

    /**
     * @param array $criteria
     * @param Builder|null $builder
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function findByCriteriaPaginated(array $criteria, ?Builder $builder = null, int $limit = 15): LengthAwarePaginator;

    /**
     * @param CriteriaInterface[] $criteria
     *
     * @return Model
     */
    public function findOneByCriteria(array $criteria): ?Model;
}
