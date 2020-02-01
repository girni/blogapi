<?php

namespace BlogApi\Core\Repositories\Eloquent;

use BlogApi\Core\Model\User;
use BlogApi\Core\Repositories\UserRepositoryInterface;
use BlogApi\Game\Model\GameType;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository extends Repository implements UserRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }


    /**
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function findPaginated(int $limit = 20): LengthAwarePaginator
    {
        return $this->model
            ->paginate($limit);
    }

    /**
     * @param array $data
     *
     * @return User
     */
    public function registerUser(array $data): User
    {
        $data['password'] = bcrypt($data['password']);

        return $this->model->create($data);
    }
}
