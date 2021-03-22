<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// お気に入り登録
Route::post('/favorite', [App\Http\Controllers\Api\OrdersApiController::class, 'store']);

Route::delete('/favorite/{id}', [App\Http\Controllers\Api\OrdersApiController::class, 'destroy']);

Route::put('/order/{id}', [App\Http\Controllers\Api\OrdersApiController::class, 'update']);
