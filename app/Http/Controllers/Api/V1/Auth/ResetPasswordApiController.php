<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\{ResetPasswordRequest, ForgetPasswordRequest};
use App\Services\Auth\PasswordService;

class ResetPasswordApiController extends Controller
{
    protected $passwordService;

    public function __construct(PasswordService $passwordService)
    {
        $this->passwordService = $passwordService;
    }

    /*
    * FETCH LOGS WITH FILTERATION
    * @param RegisterRequest $request
    * @return Collection PostsResource
    */

    public function forgetPassword(ForgetPasswordRequest $request)
    {
        try {
            // dd($request->getDTO());
            $response = $this->passwordService->forgetPassword($request->getDTO());
            return $response;
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        try {
            // dd($request->getDTO());
            $response = $this->passwordService->resetPassword($request->getDTO());
            return $response;
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

}
