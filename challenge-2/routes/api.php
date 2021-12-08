<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/register', [UserController::class,'store']);
    Route::post('/login', [UserController::class, 'login']);
});

Route::group([
    'middleware' => ['api','admin.role'],
    'prefix' => 'admin'
], function ($router) {
    Route::group([
        'prefix' => 'user-role'
    ], function ($router) {
        Route::post('/add', [UserRoleController::class, 'addUserRole']);
        Route::delete('/remove', [UserRoleController::class, 'removeUserRole']);
        Route::get('/list', [UserRoleController::class, 'getUserRoles']);
    });

});
