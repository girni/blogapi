<?php

namespace BlogApi\Core\Http\Controllers\Api\Auth;

use BlogApi\Core\Http\Controllers\Controller;
use BlogApi\Core\Http\Requests\LoginRequest;
use BlogApi\Core\Http\Resources\User as UserResource;

final class LoginController extends Controller
{
    /**
     * @param LoginRequest $request
     *
     * @return UserResource
     */
    public function login(LoginRequest $request): UserResource
    {
        if (!auth()->attempt($request->only(['email', 'password']))) {
            return response()->json([
                'message' => 'Username or password not found.',
                'errors'  => ['password' => 'Not found', 'email' => 'Not found']
            ], 401);
        }

        $user = auth()->user();
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;

        return new UserResource($user, $token);
    }
}
