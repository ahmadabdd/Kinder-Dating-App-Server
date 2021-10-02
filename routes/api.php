<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AuthController;

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

Route::post('register', [AuthController::class, 'register'])->name('api:register');
Route::post('login', [AuthController::class, 'login'])->name('api:login');
Route::get('/highlighted', [UserController::class, 'highlighted'])->name('api:highlighted');

Route::group(['middleware' => 'auth.jwt'], function () {
	Route::get('search/{keyword}', [UserController::class, 'search'])->name('api:search');
	Route::get('test', [UserController::class, 'test'])->name('api:test');
    Route::get('get_users', [UserController::class, 'getUsers'])->name('api:getUsers');
    Route::get('get_hobbies', [UserController::class, 'getHobbies'])->name('api:getHobbies');
    Route::get('get_user_hobbies', [UserController::class, 'getUserHobbies'])->name('api:getUserHobbies');
    Route::post('edit_profile', [UserController::class, 'edit_profile'])->name('api:edit_profile');
    Route::post('add_to_favorites', [UserController::class, 'addToFavorites'])->name('api:add_to_favorites');
    Route::post('add_hobbies', [UserController::class, 'addHobbies'])->name('api:addHobbies');
    Route::post('send_msg', [UserController::class, 'sendMsg'])->name('api:send_msg');
});