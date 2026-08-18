<?php

namespace App\Actions\Auth;

use App\DTOs\Auth\LoginData;
use Illuminate\Support\Facades\Auth;

class LoginUser
{
    public function handle(LoginData $data)
    {

        $credentials = [
            'email' => $data->email,
            'password' => $data->password,
        ];

        if (! Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        $user = Auth::user();

        $token = $user->createToken('auth_token')->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }
}
