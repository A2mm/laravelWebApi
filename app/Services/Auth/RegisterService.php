<?php

namespace App\Services\Auth;


use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;
use App\DTOs\Auth\RegisterDTO;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterService
{
    public function __construct()
    {
        $this->model = new User();
    }

    # LIST ALL POSTS
    public function register(RegisterDTO $registerDTO)
    {
        $userData = [
            'name'     => $registerDTO->name,
            'email'    => $registerDTO->email,
            'password' => bcrypt($registerDTO->password),
        ];

        $user = $this->model->create($userData);

        $token = Auth::login($user);

        return response()->json([
            'status'         => 'success',
            'message'        => 'User created successfully',
            'user'           => $user,
            'authorisation'  => [
                'token'      => $token,
                'type'       => 'bearer',
            ]
        ]);
    }

}
