<?php

namespace BlogApi\Core\Repositories;

use BlogApi\Core\Model\User;
use BlogApi\Game\Model\GameType;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface extends EloquentRepositoryInterface
{
    /**
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function findPaginated(int $limit = 20): LengthAwarePaginator;

    /**
     * @param array $data
     * @return User
     */
    public function registerUser(array $data): User;
}
