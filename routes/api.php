<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Auth Routes
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout')->middleware('auth:api');
    Route::post('refresh', 'refresh')->middleware('auth:api');
});


// Permission Routes
Route::apiResource('permissions', PermissionController::class)->middleware('permission:full_access');


// Role Routes
Route::group(['middleware' => ['permission:full_access']], function () {
    Route::apiResource('roles', RoleController::class);
    Route::post('roles/{roleId}/permissions', [RoleController::class, 'assignPermissions']);
});


// User Routes
Route::apiResource('users', PermissionController::class)->middleware('permission:full_access');
