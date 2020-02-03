<?php

namespace BlogApi\Core\Auth;

use BlogApi\Core\Exceptions\AppException;
use BlogApi\Core\Model\User;

interface Authenticator
{
    /**
     * @param array $credentials
     * @param bool $remember
     * @return User
     * @throws AppException
     */
    public function authenticate(array $credentials = [], bool $remember = false): User;

    /**
     * @param User $user
     * @return string
     */
    public function createToken(User $user): string;
}