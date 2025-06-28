<?php

namespace Domain\User;

use App\Http\Controllers\Controller;
use Domain\User\Request\UserLoginRequest;
use Domain\User\Request\UserRegisterRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = User::create($data);
        $token = JWTAuth::fromUser($user);
        return response()->json(['token' => $token], 201);
    }

    public function login(UserLoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        $credentials = $request->only('phone', 'password');

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return response()->json(['token' => $token]);
    }

    public function logout(): JsonResponse
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function me(): JsonResponse
    {
        return response()->json(Auth::user());
    }
}
