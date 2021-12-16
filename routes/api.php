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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Places
use App\Http\Controllers\Api\PlaceController;
Route::get('/places/list/{floor}',[PlaceController::class, 'index']) -> name('places.list');
//Cabinets
use App\Http\Controllers\Api\CabinetController;
Route::get('/cabinets/list/{floor}',[CabinetController::class, 'index']) -> name('cabinets.list');
