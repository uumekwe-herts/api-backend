<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AnonymousUserController;
use App\Http\Controllers\AnonymousUserAuthenticationController;

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

Route::get('/anon-user/reg-questions', [AnonymousUserController::class, 'regQuestions']);
Route::post('/anon-user/create', [AnonymousUserController::class, 'createAnonSecretKey']);

Route::post('/anonymous/login', [AnonymousUserAuthenticationController::class, 'login']);

Route::post('/anonymous/register', [AnonymousUserAuthenticationController::class, 'register']);

Route::group(['prefix' => '/anonymous','middleware' => ['assign.guard:anon_api','auth.jwt']],function ()
{
    Route::get('/dashboard', [AnonymousUserController::class, 'dashboard']);
    //Route::post('/logout', [AnonymousUserAuthenticationController::class, 'logout']);
});

