<?php

namespace BlogApi\Core\Http\Controllers\Api\Auth;

use BlogApi\Core\Exceptions\AppException;
use BlogApi\Core\Http\Controllers\Controller;
use BlogApi\Core\Http\Requests\LoginRequest;
use BlogApi\Core\Http\Resources\User as UserResource;
use BlogApi\Core\Auth\Authenticator;

final class LoginController extends Controller
{
    /**
     * @var Authenticator
     */
    private Authenticator $authenticator;

    public function __construct(Authenticator $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    /**
     * @param LoginRequest $request
     * @return UserResource
     * @throws AppException
     */
    public function login(LoginRequest $request): UserResource
    {
        $user = $this->authenticator->authenticate($request->only(['email', 'password']));
        $token = $this->authenticator->createToken($user);

        return new UserResource($user, $token);
    }
}
