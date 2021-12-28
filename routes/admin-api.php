<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin api routes for your application.
|
*/
use App\Http\Controllers\Admin\Api\OrderController;

Route::get('/orders', [OrderController::class, 'index']) -> name('orders.list');


use App\Http\Controllers\Admin\Api\PlacesController;

Route::get('/places/navigation', [PlacesController::class, 'navigation']) -> name('places.navigation');

use App\Http\Controllers\Admin\Api\ReservationsController;

Route::get('/reservations', [ReservationsController::class, 'index']) -> name('reservations');
