<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ItemController;
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


Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::get('/user', [AuthController::class, 'user'])->middleware('auth:api');
});

Route::group(['prefix' => 'item', 'middleware' => 'auth:api'], function () {
    Route::get('/list', [ItemController::class, 'items']);
    Route::post('/order', [ItemController::class, 'order']);
    Route::post('/sell', [ItemController::class, 'sell']);
    Route::get('/stock', [ItemController::class, 'stock']);
    Route::delete('/delete/{id}', [ItemController::class, 'delete']);
});
