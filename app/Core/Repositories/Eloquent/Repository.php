<?php

namespace BlogApi\Core\Repositories\Eloquent;

use BlogApi\Core\Repositories\Criteria\CriteriaInterface;
use BlogApi\Core\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class Repository implements EloquentRepositoryInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * Repository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param $id
     *
     * @return Model
     */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * @param Model $model
     * @param array $attributes
     *
     * @return Model
     */
    public function update(Model $model, array $attributes): Model
    {
        $model->update($attributes);

        return $model;
    }

    /**
     * @param array $attributes
     * @param array $values
     *
     * @return Model
     */
    public function updateOrCreate(array $attributes, array $values = []): Model
    {
        return $this->model->updateOrCreate($attributes, $values);
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function insert(array $data): bool
    {
        return $this->model->insert($data);
    }

    /**
     * @param Model $model
     * @return bool
     * @throws \Exception
     */
    public function delete(Model $model): bool
    {
        return $model->delete();
    }

    /**
     * @return Collection
     */
    public function findAll(): Collection
    {
        return $this->model->all();

    }

    /**
     * @param CriteriaInterface[] $criteria
     * @param Builder|null $builder
     * @return Builder
     */
    public function buildQueryByCriteria(array $criteria, ?Builder $builder = null): Builder
    {
        $query = $builder ? $builder : $this->model->newModelQuery();

        foreach ($criteria as $criterion) {
            $criterion->apply($query);
        }

        return $query;
    }

    /**
     * @param CriteriaInterface[] $criteria
     * @param Builder|null $builder
     * @return Collection
     */
    public function findByCriteria(array $criteria, ?Builder $builder = null): Collection
    {
        $query = $this->buildQueryByCriteria($criteria, $builder);

        return $query->get();
    }

    /**
     * @param CriteriaInterface[] $criteria
     * @param Builder|null $builder
     * @param int $limit
     *
     * @return LengthAwarePaginator
     */
    public function findByCriteriaPaginated(array $criteria, ?Builder $builder = null, int $limit = 15): LengthAwarePaginator
    {
        $query = $this->buildQueryByCriteria($criteria, $builder);

        return $query->paginate($limit);
    }


    /**
     * @param CriteriaInterface[] $criteria
     *
     * @return Model
     */
    public function findOneByCriteria(array $criteria): ?Model
    {
        $query = $this->buildQueryByCriteria($criteria);

        return $query->first();
    }
}
