<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\AnonymousUserController;
use App\Http\Controllers\AnonymousUserAuthenticationController;
use App\Http\Controllers\UserController;
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

Route::get('/anon-user/reg-questions', [AnonymousUserController::class, 'regQuestions']);
Route::post('/anon-user/create', [AnonymousUserController::class, 'createAnonSecretKey']);

Route::post('/anonymous/login', [AnonymousUserAuthenticationController::class, 'login']);
Route::post('/anonymous/register', [AnonymousUserAuthenticationController::class, 'register']);
Route::post('/user/register', [UserController::class, 'register']);
Route::post('/user/login', [UserController::class, 'login']);

Route::get('/ngstates', [HelperController::class, 'getNgStates']);

Route::get('/user/profile', [UserController::class, 'loggedInUser']);

Route::group(['prefix' => '/anonymous','middleware' => ['assign.guard:anon_api'] ],function ()
{
    Route::get('/profile', [AnonymousUserController::class, 'profile']);
    //Route::post('/logout', [AnonymousUserAuthenticationController::class, 'logout']);
});

Route::group(['prefix' => '/user','middleware' => ['assign.guard:user_api'] ],function ()
{
    Route::get('/profile', [UserController::class, 'profile']);
});



