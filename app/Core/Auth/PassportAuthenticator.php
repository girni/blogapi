<?php

namespace BlogApi\Core\Auth;

use BlogApi\Core\Enum\Role;
use BlogApi\Core\Exceptions\AppException;
use BlogApi\Core\Model\User;

final class PassportAuthenticator implements Authenticator
{
    /**
     * @param array $credentials
     * @param bool $remember
     * @return User
     * @throws AppException
     */
    public function authenticate(array $credentials = [], bool $remember = false): User
    {
        if (!auth()->attempt($credentials, $remember)) {
            throw new AppException('Username or password do not match.', 401);
        }

        $user = auth()->user();

        if(!$this->hasRequiredRole($user->role)) {
            throw new AppException('Insufficient permissions (Invalid role).');
        }

        return $user;
    }

    /**
     * @param User $user
     * @return string
     */
    public function createToken(User $user): string
    {
        return $user->createToken('Laravel Password Grant Client')->accessToken;
    }

    /**
     * @param string $role
     * @return bool
     */
    private function hasRequiredRole(string $role): bool
    {
        return in_array($role, Role::AUTHENTICATABLE);
    }
}