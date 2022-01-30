<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SlidersController;

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
Route::get('/slider/', [SlidersController::class, 'index']);
Route::get('/slider/{id}', [SlidersController::class, 'show']);
Route::delete('/slider/{id}', [SlidersController::class, 'destroy']);
Route::post('/slider', [SlidersController::class, 'store']);
Route::post('/slider/update', [SlidersController::class, 'update']);
Route::post('/slider/status/update', [SlidersController::class, 'updateStatus']);