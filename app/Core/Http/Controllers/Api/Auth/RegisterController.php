<?php

namespace BlogApi\Core\Http\Controllers\Api\Auth;

use BlogApi\Core\Http\Controllers\Controller;
use BlogApi\Core\Http\Requests\RegisterRequest;
use BlogApi\Core\Http\Resources\User as UserResource;
use BlogApi\Core\Repositories\UserRepositoryInterface;

final class RegisterController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;

    /**
     * RegisterController constructor.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param RegisterRequest $request
     *
     * @return UserResource
     */
    public function register(RegisterRequest $request): UserResource
    {
        $user = $this->userRepository->registerUser($request->all());

        return new UserResource($user);
    }
}