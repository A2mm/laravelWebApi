<?php

namespace App\Services\Auth;


use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;
use App\DTOs\Auth\LoginDTO;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    public function __construct()
    {
        $this->model = new User();
    }

    # LOGIN
    public function login(LoginDTO $loginDTO)
    {
        $credentials = [
            'password'  => $loginDTO->password,
            'email'     => $loginDTO->email,
        ];

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized',], 401);
        }

        $user = Auth::user();

        return response()->json(['status' => 'success', 'user' => $user, 'authorisation' => ['token' => $token, 'type' => 'bearer']]);

    }

}
