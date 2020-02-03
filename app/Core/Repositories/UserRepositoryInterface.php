<?php

namespace BlogApi\Core\Repositories;

use BlogApi\Core\Model\User;
use BlogApi\Game\Model\GameType;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface extends EloquentRepositoryInterface
{
    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User;

    /**
     * @param string $token
     * @return User|null
     */
    public function findByResetPasswordToken(string $token): ?User;

    /**
     * @param array $data
     * @return User
     */
    public function registerUser(array $data): User;
}
