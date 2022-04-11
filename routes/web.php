<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SlidersController;
use App\Http\Controllers\ProductCategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductImagesController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\TemplatesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AuthAdminsController;

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

/** Product Image Managerment **/
Route::get('/product-images', [ProductImagesController::class, 'index']);
Route::post('/product-images', [ProductImagesController::class, 'store']);
Route::delete('/product-images/{id}', [ProductImagesController::class, 'destroy']);

/** Blog Managerment **/
Route::get('/blog', [BlogsController::class, 'index']);
Route::post('/blog', [BlogsController::class, 'store']);
Route::get('/blog/{id}', [BlogsController::class, 'show']);
Route::post('/blog/update', [BlogsController::class, 'update']);
Route::post('/blog/status/update', [BlogsController::class, 'updateStatus']);
Route::post('/blog/special/update', [BlogsController::class, 'updateSpecial']);
Route::delete('/blog/{id}', [BlogsController::class, 'destroy']);

/** Templates card **/
Route::get('/template', [TemplatesController::class, 'index']);
Route::post('/template/update', [TemplatesController::class, 'update']);

/** User controller **/
Route::get('/user', [UsersController::class, 'index']);
Route::post('/invite-admin', [AuthAdminsController::class, 'inviteAdmin']);
Route::get('/sign-in-token/{token}', [AuthAdminsController::class, 'signInToken']);
Route::post('/submit-sign-in', [AuthAdminsController::class, 'submitSignInToken']);

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => []], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});