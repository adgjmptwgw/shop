<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
// ----------------------------------------------------------------------------------------------------

// ログイン画面表示
Route::get('/home', [App\Http\Controllers\GoodsController::class, 'index'])->name('home');

// ショップオーナー用の表示画面
Route::get('/goods_shop_manager', [App\Http\Controllers\GoodsController::class, 'shop_manager_index']);

// 商品の詳細画面の表示
Route::get('/goods/{id}', [App\Http\Controllers\GoodsController::class, 'details']);


// ショップ内の商品のCRUD処理(indexは一般ユーザーの購入画面)
Route::resource('goods', App\Http\Controllers\GoodsController::class)->only([
  'index', 'store', 'edit', 'update', 'destroy',
]);
// ----------------------------------------------------------------------------------------------------

// カートやお気に入り機能関係
Route::resource('order', App\Http\Controllers\OrdersController::class)->only([
  'index', 'store', 'edit', 'update', 'destroy',
]);
// 商品の購入画面表示
Route::get('/order_payment', [App\Http\Controllers\OrdersController::class, 'payment']);

// ----------------------------------------------------------------------------------------------------
// 履歴画面表示
Route::get('/order_history', [App\Http\Controllers\OrdersController::class, 'history_index']);


// ----------------------------------------------------------------------------------------------------
// 【 以下コメントやメモ 】

// 商品表示処理
// Route::get('goods', [App\Http\Controllers\GoodsController::class, 'index']);

// 商品登録処理(管理人用)
// Route::post('add_goods', [App\Http\Controllers\GoodsController::class, 'store']);

// 商品の削除
// Route::delete('goods_delete/{id}', [App\Http\Controllers\GoodsController::class, 'destroy']);


// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
