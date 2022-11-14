<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\AnonymousUserController;
use App\Http\Controllers\AnonymousUserAuthenticationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EmergencyNumberController;

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
Route::post('/admin/register', [AdminUserController::class, 'register']);
Route::post('/admin/login', [AdminUserController::class, 'login']);

Route::get('/ngstates', [HelperController::class, 'getNgStates']);

Route::get('/user/profile', [UserController::class, 'loggedInUser']);

Route::group(['middleware' => ['assign.guard:anon_api','assign.guard:user_api'] ],function ()
{
    Route::get('/cases/{user_id}/{user_type}', [IncidentController::class, 'getUserCases']);
    Route::get('/case/{case_id}', [IncidentController::class, 'getCase']);
    Route::get('/emergencyNumbers', [EmergencyNumberController::class, 'list']);
});

Route::group(['prefix' => '/anonymous','middleware' => ['assign.guard:anon_api'] ],function ()
{
    Route::get('/profile', [AnonymousUserController::class, 'profile']);
    Route::post('/submitcase', [IncidentController::class, 'submitCase']);
});

Route::group(['prefix' => '/user','middleware' => ['assign.guard:user_api'] ],function ()
{
    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('/submitcase', [IncidentController::class, 'submitCase']);
    Route::get('/case/comments/{case_id}', [CommentController::class, 'getCaseComments']);
});

Route::group(['prefix' => '/admin','middleware' => ['assign.guard:admin_api'] ],function ()
{
    Route::get('/case/{case_id}', [IncidentController::class, 'getCase']);
    Route::get('/profile', [UserController::class, 'profile']);
    Route::get('/submitted/cases', [IncidentController::class, 'getCases']);
    Route::post('/case/updateStatus', [IncidentController::class, 'updateStatus']);
    Route::post('/case/submitComment', [CommentController::class, 'submitComment']);
    Route::get('/case/comments/{case_id}', [CommentController::class, 'getCaseComments']);
    Route::get('/download/caseAttachment/{filename}', [IncidentController::class, 'downloadAttachment']);
    Route::post('/emergencyNumber/new', [EmergencyNumberController::class, 'addEmergencyNumber']);
    Route::get('/emergencyNumber/{id}', [EmergencyNumberController::class, 'getNumber']);
    Route::post('/emergencyNumber/edit', [EmergencyNumberController::class, 'edit']);
});


