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
use App\Http\Controllers\PayController;
Route::get('/pay',[PayController::class, 'pay'])-> name('test.pay');

use App\Http\Controllers\Admin\LoginController;
Route::get('/login', [LoginController::class,'showLogin']) -> name('login');
Route::post('/admin/login', [LoginController::class, 'login']) ->name('admin.login');

use App\Http\Controllers\Admin\AdminController;
Route::get('/admin', [AdminController::class,'index']) -> name('admin.home');
Route::get('/admin/orders', [AdminController::class, 'orders']) -> name('admin.orders');
