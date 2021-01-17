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
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;

Route::get('/', [PageController::class, 'Home']);
Route::get('/pb', [PageController::class, 'pb']);

Route::get('/download/{id}', [PageController::class, 'download'])->where('id','[0-9]+');

Route::resource('products', ProductController::class);
Route::resource('orders', OrderController::class);

Route::patch('/cart/cookie',[CartController::class, 'updateCookie'])->name('cart.cookie.update');
Route::delete('/cart/cookie',[CartController::class, 'deleteCookie'])->name('cart.cookie.delete');
Route::resource('cart',CartController::class);

Route::redirect('/abc', '/cart');  //從abc直接跳轉到cart  //301不會到abc直接到cart //302會到abc再到cart適合用來tracking數據
