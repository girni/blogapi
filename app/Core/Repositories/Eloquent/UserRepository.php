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
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User
    {
        return $this->model->whereEmail($email)->first();
    }


    /**
     * @param string $token
     * @return User|null
     */
    public function findByResetPasswordToken(string $token): ?User
    {
        return $this->model->where('reset_password_token', $token)->first();
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
