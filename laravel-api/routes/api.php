<?php

use App\Http\Controllers\AuthController;
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

Route::controller(AuthController::class)->group(function () {

    Route::put('user-role-remove', 'removeUserRole');
    Route::put('user-update', 'updateUserInformation');
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('roles', 'getRole');
    Route::post('roles', 'storeRole');

    Route::get('user-information', 'userInformation');
    Route::get('users', 'getUsers');


});
