<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Posts\PostApiController;
use App\Http\Controllers\Api\V1\Auth\{AuthLoginApiController, AuthRegisterApiController, ResetPasswordApiController};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('auth')->group(function()
{

    Route::post('register', [AuthRegisterApiController::class, 'register']);
    Route::post('login', [AuthLoginApiController::class, 'login']);
    Route::post('forget-password', [ResetPasswordApiController::class, 'forgetPassword']);
    Route::post('reset-password', [ResetPasswordApiController::class, 'resetPassword']);

});

Route::middleware('auth:api')->prefix('posts')->group(function()
{

    Route::get('/', [PostApiController::class, 'getPostsWithFilter']);
    Route::get('view/{id}', [PostApiController::class, 'viewPostDetails']);
    Route::post('create', [PostApiController::class, 'createPost']);

});
