<?php

namespace BlogApi\Core\Http\Controllers\Api\Auth;

use BlogApi\Core\Events\PasswordReset;
use BlogApi\Core\Exceptions\AppException;
use BlogApi\Core\Http\Controllers\Controller;
use BlogApi\Core\Http\Requests\ResetPasswordEmailRequest;
use BlogApi\Core\Http\Requests\ResetPasswordUpdateRequest;
use BlogApi\Core\Repositories\UserRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

final class ResetPasswordController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;

    /**
     * @var ResponseFactory
     */
    private ResponseFactory $responseFactory;

    /**
     * ResetPasswordController constructor.
     * @param UserRepositoryInterface $userRepository
     * @param ResponseFactory $responseFactory
     */
    public function __construct(UserRepositoryInterface $userRepository, ResponseFactory $responseFactory)
    {
        $this->userRepository = $userRepository;
        $this->responseFactory = $responseFactory;
    }

    /**
     * @param ResetPasswordEmailRequest $request
     * @return JsonResponse
     */
    public function email(ResetPasswordEmailRequest $request): JsonResponse
    {
        $user = $this->userRepository->findByEmail($request->get('email'));
        $user = $this->userRepository->update($user, [
            'reset_password_token' => Str::random(50)
        ]);

        event(new PasswordReset($user));

        return $this->responseFactory->json(['success' => true], Response::HTTP_OK);
    }

    /**
     * @param string $token
     * @return JsonResponse
     * @throws AppException
     */
    public function verifyToken(string $token): JsonResponse
    {
        if(null === $this->userRepository->findByResetPasswordToken($token)) {
            throw new AppException('Invalid token.', Response::HTTP_BAD_REQUEST);
        }

        return $this->responseFactory->json(['success' => true], Response::HTTP_OK);
    }

    /**
     * @param ResetPasswordUpdateRequest $request
     * @param string $token
     * @return JsonResponse
     * @throws AppException
     */
    public function update(ResetPasswordUpdateRequest $request, string $token): JsonResponse
    {
        $user = $this->userRepository->findByResetPasswordToken($token);

        if(null === $user) {
            throw new AppException('Invalid token.', Response::HTTP_BAD_REQUEST);
        }

        $this->userRepository->update($user, [
            'password' => bcrypt($request->get('password')),
            'reset_password_token' => null
        ]);

        return $this->responseFactory->json(['success' => true], Response::HTTP_OK);
    }
}