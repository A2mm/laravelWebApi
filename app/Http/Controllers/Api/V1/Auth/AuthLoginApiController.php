<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\LoginService;

class AuthLoginApiController extends Controller
{
    protected $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    /*
    * FETCH LOGS WITH FILTERATION
    * @param RegisterRequest $request
    * @return Collection PostsResource
    */

    public function login(LoginRequest $request)
    {
        try {
            // dd($request->getDTO());
            $response = $this->loginService->login($request->getDTO());
            return $response;
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

}
