<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;


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

require __DIR__.'/auth.php';

Route::get('redirects', 'App\Http\Controllers\LoginController@index');
// 商品一覧（ユーザー）
Route::get('/products', 'App\Http\Controllers\ProductsController@index')->name('products');
Route::get('/', 'App\Http\Controllers\ProductsController@index');

// ユーザー以上
Route::group(['middleware' => ['auth', 'can:user-higher']], function () {
    // 商品詳細
    Route::get('show/{id}', [ProductController::class, 'show'])->name('products.show');
    // 決済確認（カート）
    Route::prefix('cart')->middleware('auth')->group(function(){
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('add', [CartController::class, 'add'])->name('cart.add');
        Route::post('delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
        Route::get('checkout', [CartController::class, 'checkout'])->name('cart.checkout');
        Route::post('checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    });
    // 会員編集
    Route::get('/user/edit',[App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
    Route::patch('/user/update',[App\Http\Controllers\UserController::class, 'update'])->name('user.update');
    // 会員削除
    // Route::delete('/user/delete',[App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');
    // 問い合わせ
    Route::get('/add', [App\Http\Controllers\ContactController::class, 'add'])->name('contact.add');
    Route::post('/add', [App\Http\Controllers\ContactController::class, 'create'])->name('contact.create');
    Route::get('/order/history', [OrderController::class, 'history'])->name('order.history');
});


// 管理者以上
Route::group(['middleware' => ['auth', 'can:admin-higher']], function () {
    // 管理者画面
    Route::get('/admin','App\Http\Controllers\AdminController@index')->name('admin');
    // 商品一覧（管理者）
    Route::get('/product',[App\Http\Controllers\ProductController::class, 'index'])->name('index');
    // 商品検索
    Route::post('/products/search',[App\Http\Controllers\ProductController::class, 'search'])->name('search');
    // 商品登録
    Route::get('/product/create',[App\Http\Controllers\ProductController::class, 'create'])->name('create');
    Route::post('/product/store',[App\Http\Controllers\ProductController::class, 'store'])->name('store');
    // 商品編集
    Route::get('/product/edit',[App\Http\Controllers\ProductController::class, 'edit'])->name('edit');
    Route::patch('/product/update',[App\Http\Controllers\ProductController::class, 'update'])->name('update');
    // 商品削除
    // Route::delete('/product/delete',[App\Http\Controllers\ProductController::class, 'delete'])->name('delete');
    // 問い合わせ一覧
    Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.index'); //未対応ページ
    Route::get('/contact2', [App\Http\Controllers\ContactController::class, 'index2'])->name('contact.index2'); //対応済ページ
    Route::post('/contact', [App\Http\Controllers\ContactController::class, 'update'])->name('contact.update');
    // 受注一覧
    Route::get('/order', [App\Http\Controllers\OrderController::class, 'index'])->name('order.index'); //未対応ページ
    Route::get('/order2', [App\Http\Controllers\OrderController::class, 'index2'])->name('order.index2'); //対応済ページ
    Route::post('/order', [App\Http\Controllers\OrderController::class, 'update'])->name('order.update');


});
