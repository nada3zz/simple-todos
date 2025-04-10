<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function __construct(protected AuthService $AuthService)
    {
    }

    public function register( RegisterRequest $request): JsonResponse
    {
        // return response()->json([
        //     'message' => 'Registration is not implemented yet',
        //     'data' => $request->validated(),
        // ], 501);
        $user = $this->AuthService->register($request->validated());
        return response()->json([
            'user' => $user,
        ], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $user = $this->AuthService->login($request->validated());
        return response()->json([
            'user' => $user
        ], 200);
    }

    // public function logout()
    // {
    //     return auth()->user();
    //     auth()->user()->token->delete();
    //     return response()->json(['message' => 'Logged out successfully']);
    // }
}
