<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\RegisterService;

class AuthRegisterApiController extends Controller
{
    protected $registerService;

    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    /*
    * FETCH LOGS WITH FILTERATION
    * @param RegisterRequest $request
    * @return Collection PostsResource
    */

    public function register(RegisterRequest $request)
    {
        try {
            // dd($request->getDTO());
            $response = $this->registerService->register($request->getDTO());
            return $response;
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

}
