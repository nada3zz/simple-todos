<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User\User;

class AuthService
{
    public function register( array $data): User
    {
        if (User::where('email', $data['email'])->exists()) {
            throw ValidationException::withMessages([
                'email' => ['The email has already been taken.'],
            ]);
        }

        $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        $user->token = $token;
        return $user;
    }

    public function login(array $data): User
    {
        $credentials = [
            'email' => $data['email'],
            'password' => $data['password'],
        ];

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user = User::where('email', $data['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        $user->token = $token;

        return $user;
    }
}
