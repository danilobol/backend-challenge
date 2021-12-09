<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\mLearnController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserGroupController;
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
    'prefix' => 'group'

], function ($router) {
    Route::post('/create', [GroupController::class,'store'])->middleware('api.jwt');
    Route::get('/show', [GroupController::class,'show']);
    Route::get('/my-group-show', [GroupController::class,'showOwnerGroup'])->middleware('api.jwt');

    Route::group([
        'middleware' => 'api.jwt',
        'prefix' => 'user'
    ], function ($router) {
        Route::post('/add', [UserGroupController::class, 'store']);
        Route::delete('/delete', [UserGroupController::class, 'delete']);
        Route::get('/show', [UserGroupController::class, 'index']);
    });

});

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

Route::group([
    'middleware' => ['api','admin.role'],
    'prefix' => 'm-learn'

], function ($router) {
    Route::post('/user', [mLearnController::class,'findUser']);
    Route::post('/group-user', [mLearnController::class, 'getUserGroups']);
});
