<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\RosreestrController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


//Авторизация
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api');
    Route::post('/profile', [AuthController::class, 'profile'])->middleware('auth:api');
});

//Получение данных из Росеестра
Route::group([
    'middleware' => 'api',
    'prefix' => 'rosreestr'
], function () {
    Route::post('/getInformationByNumber/{cadastral_nubmer}',
        [RosreestrController::class, 'getInformationByNumber']
    )->middleware('auth:api');
});

