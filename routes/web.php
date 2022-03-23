<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SlidersController;
use App\Http\Controllers\ProductCategoriesController;
use App\Http\Controllers\ProductsController;

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

/** Slider Route **/
Route::get('/slider/', [SlidersController::class, 'index']);
Route::get('/slider/{id}', [SlidersController::class, 'show']);
Route::delete('/slider/{id}', [SlidersController::class, 'destroy']);
Route::post('/slider', [SlidersController::class, 'store']);
Route::post('/slider/update', [SlidersController::class, 'update']);
Route::post('/slider/status/update', [SlidersController::class, 'updateStatus']);

/** Product Category **/
Route::get('/product-category/', [ProductCategoriesController::class, 'index']);
Route::post('/product-category', [ProductCategoriesController::class, 'store']);
Route::delete('/product-category/{id}', [ProductCategoriesController::class, 'destroy']);
Route::get('/product-category/{id}', [ProductCategoriesController::class, 'show']);
Route::post('/product-category/update', [ProductCategoriesController::class, 'update']);
Route::post('/product-category/status/update', [ProductCategoriesController::class, 'updateStatus']);

/** Products managerment **/
Route::get('/product/', [ProductsController::class, 'index']);
Route::post('/product', [ProductsController::class, 'store']);
Route::get('/product/{id}', [ProductsController::class, 'show']);
Route::post('/product/update', [ProductsController::class, 'update']);
Route::post('/product/status/update', [ProductsController::class, 'updateStatus']);
Route::delete('/product/{id}', [ProductsController::class, 'destroy']);

// Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
//     \UniSharp\LaravelFilemanager\Lfm::routes();
// });
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => []], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});